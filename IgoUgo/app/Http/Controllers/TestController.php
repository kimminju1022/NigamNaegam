<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function sendTestEmail()
    {
        // // 수신자 이메일 주소와 내용
        // Mail::raw('이것은 Mailtrap을 통해 전송된 테스트 이메일입니다.', function ($message) {
        //     $message->to('recipient@example.com')  // 실제 이메일 수신자
        //             ->subject('테스트 이메일');
        // });

        // return response()->json(['message' => '테스트 이메일이 전송되었습니다.']);

        // 이메일 본문 설정
        $subject = '테스트 이메일';
        $content = '이것은 Mailtrap을 통해 전송된 테스트 이메일입니다.';
        $to = 'example@mailtrap.io';  // 실제로 수신할 이메일 주소

        // 이메일 보내기
        Mail::raw($content, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });

        Log::debug('디버그 메시지');
        Log::info('정보 메시지');
        Log::error('에러 메시지');

        return response()->json(['message' => '테스트 이메일이 전송되었습니다.']);
    }
}
