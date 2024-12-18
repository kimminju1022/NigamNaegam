<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function store(UserRequest $request) {
        $insertData['user_email'] = $request->email;
        $insertData['user_name'] = $request->name;
        $insertData['user_nickname'] = $request->nickname;
        $insertData['user_phone'] = $request->phone;
        $insertData['user_password'] = Hash::make($request->password);

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
    public function update(UserRequest $request, $id) {
        // Log::debug('user update request', $request->all());

        $userInfo = User::find($id);
        $userInfo->user_name = $request->name;
        $userInfo->user_nickname = $request->nickname;
        $userInfo->user_phone = $request->phone;

        $userInfo->save();

        $responseData = [
            'success' => true
            ,'msg' => '유저 정보 업데이트 성공'
            ,'userInfo' => $userInfo->toArray()
        ];


        return response()->json($responseData, 200);
    }
}
