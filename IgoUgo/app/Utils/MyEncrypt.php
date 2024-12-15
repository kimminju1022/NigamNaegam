<?php

namespace App\Utils;

use Illuminate\Support\Str;

class MyEncrypt {
    // base64 URL Encode
    // 문자열을 base64로 encode
    public function base64UrlEncode(string $json) {
        return rtrim(strtr(base64_encode($json), '+/', '-_'),'=');
    }
    
    // base64 URL Decode
    public function base64UrlDecode(string $base64) {
        return base64_decode(strtr($base64, '-_', '+/'));
    }


    // salt 생성
    public function makeSalt($saltLength) {
        return Str::random($saltLength);
    }

    // 문자열 암호화 hash
    public function hashWithSalt(string $alg, string $str, string $salt) {
        return hash($alg, $str).$salt;
    }

    // salt 제거한 문자열 반환
    public function subSalt(string $signature, int $saltLength) {
        return mb_substr($signature, 0, (-1 * $saltLength));
    }
}