<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserRequest $request) {
        // $insertData = $request->only('email', 'name', 'nickname', 'phone');
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
}
