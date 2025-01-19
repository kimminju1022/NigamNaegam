<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\MyVerifyEmail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function notice(Request $request) {

        $responseData = [
            'success' => true
            // ,'msg' => '이메일 성공'
        ];

        return response()->json($responseData, 200);
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill(); // 1. 이메일 검증 처리

        return redirect('/'); // 2. 이메일 검증 후 홈으로 리다이렉트
    }

    public function sendVerificationLink(Request $request) {

        $user = $request->user; // 인증된 사용자
        // $user = User::where('user_email', $request->user_email)->first();

        // Log::debug('Request data:', $request->all());
        // Log::debug('User: ', ['user' => $user]);
        // Log::debug($user->user_email);

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => '이미 이메일이 인증되었습니다.']);
        }

        // $request->user->sendEmailVerificationNotification(); // 1. 이메일 검증 링크 재전송
        $user->notify(new MyVerifyEmail());

        // 이건 되는뎁쇼 -------------------------------------------
        $subject = '테스트 이메일';
        $content = '이메일 테스트하는 중 하하하하하';
        // $to = 'example@mailtrap.io';  // 실제로 수신할 이메일 주소
        $to = $user->user_email; // 이렇게 해도 왜 example@mailtrap.io여기로감?

        // 이메일 보내기
        Mail::raw($content, function ($message) use ($to, $subject) {
                $message->to($to)
                ->subject($subject);
        });
        // -------------------------------------------------------

        // return back()->with('message', 'Verification link sent!'); // 2. 성공 메시지 반환
        $responseData = [
            'success' => true
            ,'msg' => '이메일 전송 성공'
        ];

        return response()->json($responseData, 200);
    }
}
