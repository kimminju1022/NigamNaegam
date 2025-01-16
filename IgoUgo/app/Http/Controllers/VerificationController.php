<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify() {


        
        $responseData = [
            'success' => true
            ,'msg' => '이메일 성공'
        ];

        return response()->json($responseData, 200);
    }

    public function verifiedEmail(EmailVerificationRequest $request) {
        $request->fulfill();
    
        // 이미 인증한 이메일이 input으로 적혀있게는 어떻게 함?
        return redirect('/registration');
    }

    public function sendEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    }
}
