<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use MyToken;

class UserController extends Controller
{
    public function store(UserRequest $request) {
        Log::debug('user request : ', $request->all());
        $insertData['user_email'] = $request->user_email;
        $insertData['user_name'] = $request->user_name;
        $insertData['user_nickname'] = $request->user_nickname;
        $insertData['user_phone'] = $request->user_phone;
        $insertData['user_password'] = Hash::make($request->user_password);

        User::create($insertData);

        $responseData = [
            'success' => true
            ,'msg' => '회원가입 성공'
        ];

        return response()->json($responseData, 200);
    }

    
    // 유저 조회
    public function show($id) {
        $userInfo = User::find($id);

        // return response()->json($userInfo); 
        $responseData = [
            'success' => true
            ,'msg' => '유저 정보 획득 성공'
            ,'userInfo' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 유저 수정페이지로
    public function edit($id) {
        $userInfo = User::find($id);
    
        $responseData = [
            'success' => true
            ,'msg' => '유저 정보 획득 성공'
            ,'userInfo' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 유저 수정 업데이트
    public function update(UserRequest $request) {
        // Log::debug('user update request', $request->all());

        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        $userInfo = User::find($id);
        
        if($userInfo->user_name !== $request->user_name) {
            $userInfo->user_name = $request->user_name;
        } else if($userInfo->user_nickname !== $request->user_nickname) {
            $userInfo->user_nickname = $request->user_nickname;
        } else if($userInfo->user_phone !== $request->user_phone) {
            $userInfo->user_phone = $request->user_phone;
        } else if($userInfo->user_profile !== $request->user_profile) {
            $userInfo->user_profile = $request->user_profile;
        }

        $userInfo->save();

        $responseData = [
            'success' => true
            ,'msg' => '유저 정보 업데이트 성공'
            ,'userInfo' => $userInfo->toArray()
        ];


        return response()->json($responseData, 200);
    }

    // 유저 탈퇴
    public function destroy(Request $request) {
        // Log::debug('user update request : ', $request->all());
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        
        // Log::debug('user id request : ', ['id' => $id]);
        $user = User::find($id);

        // Log::debug('user id request : ', ['user' => $user]);
        $user->delete();
        // refreshToken 갱신
        MyToken::updateRefreshToken($user, null);   

        $responseData = [
            'success' => true
            ,'msg' => '회원 정보 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }
}
