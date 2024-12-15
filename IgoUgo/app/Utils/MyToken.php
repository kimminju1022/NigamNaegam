<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MyEncrypt;
use PDOException;
use App\Exceptions\MyAuthException;

class MyToken {
    // AccessToken & RefreshToken 생성
    public function createTokens(User $user) {
        $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));
        $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'), false);

        return [$accessToken, $refreshToken];
    }

    // JWT 생성
    private function createToken(User $user, int $ttl, bool $accessFlg = true) {
        $header = $this->createHeader();
        $payload = $this->createPayload($user, $ttl, $accessFlg);
        $signature = $this->createSignature($header, $payload);
        
        return $header.'.'.$payload.'.'.$signature;
    }

    // JWT Header
    private function createHeader() {
        $header = [
            'alg' => env('TOKEN_ALG')
            ,'typ' => env('TOKEN_TYPE')
        ];

        return MyEncrypt::base64UrlEncode(json_encode($header));
    }

    // JWT Payload
    private function createPayload(User $user, int $ttl, bool $accessFlg = true) {
        $now = time(); // 현재 시간
    
        $payload = [
            'idt' => $user->user_id
            ,'iat' => $now
            ,'exp' => $now + $ttl
            ,'ttl' => $ttl
        ];
    
        // 엑세스 토큰일 경우 아래 데이터 추가
        if($accessFlg) {
            $payload['acc'] = $user->user_email;
        }
    
        return MyEncrypt::base64UrlEncode(json_encode($payload));
    }

    // JWT Signature
    private function createSignature(string $header, string $payload) {
        return MyEncrypt::hashWithSalt(env('TOKEN_ALG'), $header.env('TOKEN_SECRET_KEY').$payload, MyEncrypt::makeSalt(env('TOKEN_SALT_LENGTH')));
    }

    // RefreshToken Update
    public function updateRefreshToken(User $userInfo, string|null $refreshToken) {
        // 유저 모델에 리프레시 토큰 변경
        $userInfo->refresh_token = $refreshToken;
    
        if(!($userInfo->save())) {
            DB::rollBack();
            throw new PDOException('Error updateRefreshToken()'); 
        }
    
        return true;
    }

    // 토큰 유효성 체크
    public function chkToken(string|null $token) {
        Log::debug("********** chkToken Start **********");

        // 토큰 존재 유무 체크
        if(empty($token)) {
            throw new MyAuthException('E20');
        }

        list($header, $payload, $signature) = $this->explodeToken($token);
        if(MyEncrypt::subSalt($this->createSignature($header, $payload), env('TOKEN_SALT_LENGTH')) !== MyEncrypt::subSalt($signature, env('TOKEN_SALT_LENGTH'))) {
            throw new MyAuthException('E22');
        }
    
        // 유효시간 체크
        if($this->getValueInPayload($token, 'exp') < time()) {
            throw new MyAuthException('E21');
        }

        Log::debug("********** chkToken End **********");
        return true;
    }

    // 토큰 분리
    private function explodeToken($token) {
        $arrToken = explode('.', $token);

        // 토큰 분리 오류 체크
        if(count($arrToken) !== 3) {
            throw new MyAuthException('E23');
        }

        return $arrToken;
    }

    // Payload에서 추출
    public function getValueInPayload(string $token, string $key) {
        // 토큰 분리
        list($header, $payload, $signature) = $this->explodeToken($token);
        $decodedPayload = json_decode(MyEncrypt::base64UrlDecode($payload));
    
        // payload에 해당 키의 데이터가 있는지 체크
        if(empty($decodedPayload) || !isset($decodedPayload->$key)) {
            throw new MyAuthException('E24');
        }
    
        return $decodedPayload->$key;
    }
}