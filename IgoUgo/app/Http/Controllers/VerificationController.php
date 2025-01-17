<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function notice(Request $request) {

        $responseData = [
            'success' => true
            ,'msg' => '이메일 성공'
        ];

        return response()->json($responseData, 200);
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill(); // 1. 이메일 검증 처리

        return redirect('/registration'); // 2. 이메일 검증 후 홈으로 리다이렉트
    }

    public function sendVerificationLink(Request $request) {
        $request->user()->sendEmailVerificationNotification(); // 1. 이메일 검증 링크 재전송
    
        return back()->with('message', 'Verification link sent!'); // 2. 성공 메시지 반환
    }
}
