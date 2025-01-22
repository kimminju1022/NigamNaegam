<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MyToken;

class AuthController extends Controller
{
    // 로그인
    public function login(UserRequest $request) {
        $userInfo = User::where('user_email', $request->user_email)->first();

        // 비밀번호 체크
        if(!(Hash::check($request->user_password, $userInfo->user_password))) {
            throw new AuthenticationException('비밀번호 체크 오류');
        }

        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // refreshToken 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);
        
        $responseData = [
            'success' => true
            ,'msg' => '로그인 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
            ,'data' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 로그아웃
    public function logout(Request $request) {
        // Payload에서 유저id 획득
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');
    
        DB::beginTransaction();

        // 유저 정보 획득
        $userInfo = User::find($id);
    
        // refreshToken 갱신
        MyToken::updateRefreshToken($userInfo, null);   

        DB::commit();
        
        $responseData = [
            'success' => true
            ,'msg' => '로그아웃 성공'
        ];
    
        return response()->json($responseData, 200);
    }

    // 토큰 재발급
    public function reissue(Request $request) {
        // Payload에서 유저 PK 획득
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        // 유저 정보 획득
        $userInfo = User::find($id);

        // refreshToken 비교
        if($request->bearerToken() !== $userInfo->refresh_token) {
            throw new MyAuthException('E22'); // 만료된 토큰입니다
        }

        // 토큰 발급
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // refreshToken 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);
        
        $responseData = [
            'success' => true
            ,'msg' => '토큰 재발급 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
        ];

        return response()->json($responseData, 200);
    }

    // 비밀번호 변경 이메일 보내기
    public function sendEmail(Request $request) {
        $verified_user = User::where('user_email', $request->user_email)
                                ->first();

        Log::debug('verified_user :'.$verified_user);

        if (!$verified_user) {
            return response()->json(['success' => false, 'msg' => '사용자를 찾을 수 없습니다.'], 404);
        }

        $verified_user->password_reset_token = Str::random(64);
        $verified_user->password_reset_expires_at = Carbon::now()->addMinutes(30);
        $verified_user->save();

        $subject = '비밀번호를 변경해주세요!';
        $to = $request->user_email; // 수신자 이메일 주소
        $url = env('APP_URL').'/find/pw/'.$verified_user->user_id.'/'.sha1($verified_user->password_reset_token);

        // 이메일 보내기
        Mail::send('verificationPassword', [
            'url' => $url,
        ], function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });

        $responseData = [
            'success' => true
            ,'msg' => '이메일 전송 성공'
        ];

        return response()->json($responseData, 200);
    }

    public function verify($id, $hash) {
        $verification = User::where('user_id', $id)
                                ->first();

        Log::debug('Autcontroller verify :'.$verification);
        
        if (!$verification) {
            return redirect('/login')->with('error', '사용자를 찾을 수 없습니다.');

            $responseData = [
                'success' => false
                ,'msg' => '사용자 확인 실패'
            ];
            
            return response()->json($responseData, 401);
        }

        $hashed = sha1($verification->password_reset_token);

        if ($hashed === $hash && $verification->password_reset_expires_at > now()) {
            // User::where('user_email', $hash)
            //             ->first();

            $responseData = [
                'success' => true
                ,'msg' => '이메일 인증 성공'
                ,'user_email' => $verification->user_email
            ];
            
            return response()->json($responseData, 200);
        }
    }
}
