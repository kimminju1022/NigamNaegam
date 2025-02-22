<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    // 로그 레포트
    public function report(Throwable $th) {
        // 예외 코드 초기화
        // $code = 'E99';

        // // 인스턴스 확인 후 예외 정보 변경
        // if(
        //     $th instanceof AuthenticationException
        //     || $th instanceof PDOException
        // ) {
        //     $code = $th->getMessage();
        // }
        
        // $context = $this->context();
        // $errInfo = $context[$code];

        // // Response Data 생성
        // $responseData = [
        //     'success' => false
        //     ,'code' => $code
        //     ,'msg' => $errInfo['msg']
        // ];

        // return response()->json($responseData, $errInfo['status']);

        // Log::info($code.' : '.$errInfo['msg']);

        Log::info('Report : '.$th->getMessage());
    }

    // 에러 핸들링 커스텀
    public function render($request, Throwable $th) {
        // 예외 코드 초기화
        $code = 'E99';

        // 인스턴스 확인 후 예외 정보 변경 (기본 제공되는 클래스 이용)
        if($th instanceof AuthenticationException) {
            $code = 'E01';
        } else if($th instanceof PDOException) {
            $code = 'E80';
        }

        $errInfo = $this->context()[$code];

        // TODO : 이거 다시 ------------------------------------------------
        // 커스텀 Exception 인스턴스 확인
        if($th instanceof MyAuthException) {
            $code = $th->getMessage();
            $errInfo = $th->context()[$code];
        }
            
        // 예외가 AuthenticationException이라면, 메시지를 동적으로 처리
        if($th instanceof AuthenticationException) {
            $errInfo = [
                'status' => 401,
                'msg' => $th->getMessage() // 예외에서 받은 메시지를 그대로 사용
            ];
        }

        // Response Data 생성
        $responseData = [
            'success' => false
            ,'code' => $code
            ,'msg' => $errInfo['msg']
        ];

        return response()->json($responseData, $errInfo['status']);
    }

    // 에러 메시지 리스트
    public function context() {
        return [
            'E01' => ['status' => 401, 'msg' => '인증 실패']
            ,'E80' => ['status' => 500, 'msg' => 'DB 에러가 발생했습니다.']
            ,'E99' => ['status' => 500, 'msg' => '시스템 에러가 발생했습니다.']
            
            // ,'E20' => ['status' => 401, 'msg' =>'토큰이 없습니다.']
            // ,'E21' => ['status' => 401, 'msg' =>'만료된 토큰입니다.']
            // ,'E22' => ['status' => 401, 'msg' =>'위조된 토큰입니다.']
            // ,'E23' => ['status' => 401, 'msg' =>'양식에 맞지 않는 토큰입니다.']
            // ,'E24' => ['status' => 401, 'msg' =>'토큰 정보에 이상이 있습니다.']
        ];
    }
}
