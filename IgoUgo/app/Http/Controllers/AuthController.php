<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyToken;

class AuthController extends Controller
{
    // 로그인
    public function login(UserRequest $request) {
        $userInfo = User::where('user_email', $request->email)->first();

        // 비밀번호 체크
        if(!(Hash::check($request->password, $userInfo->user_password))) {
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
}
