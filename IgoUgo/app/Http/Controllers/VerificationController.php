<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verification;
use App\Notifications\MyVerifyEmail;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class VerificationController extends Controller
{
    public function notice(Request $request) {

        $responseData = [
            'success' => true
            // ,'msg' => '이메일 성공'
        ];

        return response()->json($responseData, 200);
    }

    public function verify($id, $hash) {
    // public function verify(Request $request) {
        // Log::debug('인증이메일', $request->all());
        // $request->fulfill(); // 1. 이메일 검증 처리
        
        // $user = Verification::find($id);        
        $verification = Verification::where('verified_email_id', $id)
                        ->first();

        if (!$verification) {
            // return redirect('/')->with('error', '사용자를 찾을 수 없습니다.');

            $responseData = [
                'success' => false
                ,'msg' => '사용자 확인 실패'
            ];
            
            return response()->json($responseData, 401);
        }

        $hashedEmail = sha1($verification->user_email);

        if ($hashedEmail === $hash) {
            // email_verified_at = now(); 이거 넣어줘야하는뎁
            Verification::where('verified_email_id', $id)
                        ->update(['email_verified_at' => Carbon::now()]);

            $responseData = [
                'success' => true
                ,'msg' => '이메일 인증 성공'
                ,'user_email' => $verification->user_email
            ];
            
            return response()->json($responseData, 200);
        } else {
            $verifiedEmail = Verification::find($id);
            $verifiedEmail->delete();

            $responseData = [
                'success' => false
                ,'msg' => '이메일 인증 실패'
            ];

            return response()->json($responseData, 401);
        }
    }

    public function sendVerificationLink(Request $request) {

        // $user = $request->user; // 인증된 사용자
        // $user = User::where('user_email', $request->user_email)->first();

        // Log::debug('Request data:', $request->all());
        // Log::debug($request->user_email);

        // if ($user->hasVerifiedEmail()) {
        //     return response()->json(['message' => '이미 이메일이 인증되었습니다.']);
        // }
        // $request->user->sendEmailVerificationNotification(); // 1. 이메일 검증 링크 전송
        // $user->notify(new MyVerifyEmail());

        // 이건 되는뎁쇼 -------------------------------------------
        // $subject = '테스트 이메일 250120';
        // $content = '이메일 테스트하는 중 하하하하하';
        // // $to = 'example@mailtrap.io';  // 실제로 수신할 이메일 주소
        // $to = $user->user_email; // 이렇게 해도 왜 example@mailtrap.io여기로감?

        try {
            DB::beginTransaction();
            
            $insertData['user_email'] = $request->user_email;
            $insertData['hash_email'] = sha1($request->user_email);
        
            Verification::create($insertData);
            $verified_user = Verification::where('user_email', $request->user_email)
                                            ->first();
    
            // Log::debug('verified_user :'.$verified_user);
    
            $subject = '이메일 인증을 완료해 주세요!';
            $to = $request->user_email; // 수신자 이메일 주소
            $url = env('APP_URL').'/email/verify/'.$verified_user->verified_email_id.'/'.sha1($verified_user->user_email);
            // $url = env('APP_URL').'/email/verify/'.sha1($request->user_email);
    
            // 이메일 보내기
            Mail::send('verificationEmail', [
                'url' => $url,
            ], function ($message) use ($to, $subject) {
                $message->to($to)
                        ->subject($subject);
            });

            DB::commit();
            
            $responseData = [
                'success' => true
                ,'msg' => '이메일 전송 성공'
            ];

            return response()->json($responseData, 200);
        } catch(Throwable $th) {
            DB::rollBack();
            Log::debug($th->getMessage());
        }

    }
}
