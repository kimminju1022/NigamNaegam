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
        $user = Verification::where('verified_email_id', $id)->first();

        if (!$user) {
            return redirect('/')->with('error', '사용자를 찾을 수 없습니다.');
        }

        $hashedEmail = sha1($user->user_email);

        // if (hash_equals($hashedEmail, $hash)) { // hash 비교에 이게 더 좋나?
        if ($hashedEmail === $hash) {
            // email_verified_at = now(); 이거 넣어줘야하는뎁
            Verification::where('verified_email_id', $id)
                        ->update(['email_verified_at' => Carbon::now()]);

            return redirect('/registration')->with('success', '이메일 인증이 완료되었습니다.');
        } else {
            return redirect('/')->with('error', '잘못된 인증 요청입니다.');
        }
        // if(sha1($user->user_email) === $request->hash_email){
            
        //     // // return redirect('/'.$id.'/registration'); // 2. 이메일 검증 후 리다이렉트
        //     // return redirect('/registration');
        // } else {
        //     return redirect('/')->with('error', '잘못된 인증 요청입니다.');
        // }
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
            $verified_user = Verification::where('user_email', $request->user_email)->first();
    
            // Log::debug('verified_user :'.$verified_user);
    
            $subject = '이메일 인증을 완료해 주세요!';
            $to = $request->user_email; // 수신자 이메일 주소
            $url = env('APP_URL').'/email/verify/'.$verified_user->verified_email_id.'/'.sha1($verified_user->user_email);
            // $url = env('APP_URL').'/email/verify/'.sha1($request->user_email);
    
            // // 이메일 보내기
            Mail::send('verificationEmail', [
                'name' => $request->user_name,  // Blade 템플릿에서 사용할 변수
                'url' => $url,          // 인증 URL
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
