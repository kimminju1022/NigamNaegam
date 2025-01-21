<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use MyToken;

class UserController extends Controller
{
    public function store(UserRequest $request) {
        // Log::debug('user request : ', $request->all());
        $insertData['user_email'] = $request->user_email;
        $insertData['user_name'] = $request->user_name;
        $insertData['user_nickname'] = $request->user_nickname;
        $insertData['user_phone'] = $request->user_phone;
        $insertData['user_password'] = Hash::make($request->user_password);
        
        $verified_email = Verification::where('user_email', $request->user_email)->first();

        $insertData['email_verified_at'] = $verified_email->email_verified_at;
        
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

        $responseData = [
            'success' => true
            ,'msg' => '유저 정보 획득 성공'
            ,'userInfo' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 유저 수정페이지로 이동
    public function edit($id) {
        $userInfo = User::find($id);
    
        $responseData = [
            'success' => true
            ,'msg' => '유저 정보 획득 성공'
            ,'userInfo' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 유저 정보 업데이트
    public function update(UserRequest $request) {
        // Log::debug('user update request', $request->all());

        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        $userInfo = User::find($id);
    
        if($userInfo->user_name !== $request->user_name) {
            $userInfo->user_name = $request->user_name;
        }
        if($userInfo->user_nickname !== $request->user_nickname) {
            $userInfo->user_nickname = $request->user_nickname;
        }
        if($userInfo->user_phone !== $request->user_phone) {
            $userInfo->user_phone = $request->user_phone;
        }
        if($request->hasFile('user_profile')) {
            $userProfile = '/'.$request->file('user_profile')->store('profile');
            $userInfo->user_profile = $userProfile;
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

    // 유저 비밀번호 확인 -> 수정페이지로 이동
    public function chkPW(UserRequest $request) {

        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => '사용자를 찾을 수 없습니다.'], 404);
        }

        // 비밀번호 체크
        if (Hash::check($request->input('user_password'), $user->user_password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['message' => '비밀번호가 틀렸습니다.'], 422);
        }
    }

    // 유저 비밀번호 업데이트
    public function updatePW(UserRequest $request) {

        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => '사용자를 찾을 수 없습니다.'], 404);
        }

        if (!Hash::check($request->currentPassword, $user->user_password)) {
            return response()->json(['message' => '현재 비밀번호가 일치하지 않습니다.'], 400);
        }

        if ($request->newPassword !== $request->newPasswordChk) {
            return response()->json(['message' => '새 비밀번호와 비밀번호 확인이 일치하지 않습니다.'], 400);
        }

        // 새 비밀번호 해싱 후 저장
        $user->user_password = Hash::make($request->newPassword);

        // 비밀번호 변경
        $user->save();

        // 변경 성공 메시지 반환
        return response()->json(['message' => '비밀번호가 성공적으로 변경되었습니다.']);
    }

    // 이메일 중복확인
    public function chkEmail(UserRequest $request) {
        $request->validate([
            'user_email' => 'required|email',
        ]);
    
        // Log::debug($request->all());

        $userInfo = User::where('user_email', $request->user_email)->first();
        // Log::debug($userInfo);
        
        if($userInfo) {
            return response()->json(['message' => '이미 있는 이메일입니다.'], 409);
            // throw new AuthenticationException('이메일 중복 체크 오류');
        }
        
        // return response()->json(['message' => '사용할 수 있는 이메일입니다.']);
        
        $responseData = [
            'success' => true
            ,'msg' => '이메일 중복확인 성공'
            // ,'data' => $userInfo->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 닉네임 중복확인
    public function chkNickname(UserRequest $request) {
        $userInfo = User::where('user_nickname', $request->user_nickname)->first();
        // Log::debug($userInfo);
        
        if($userInfo) {
            return response()->json(['message' => '이미 있는 닉네임입니다.'], 409);
        }
        
        $responseData = [
            'success' => true
            ,'msg' => '닉네임 중복확인 성공'
        ];
        return response()->json($responseData, 200);
    }

    // 전화번호 중복확인
    public function chkPhone(UserRequest $request) {
        $userInfo = User::where('user_phone', $request->user_phone)->first();
        // Log::debug($userInfo);
        
        if($userInfo) {
            return response()->json(['message' => '이미 있는 전화번호입니다.'], 409);
        }

        $responseData = [
            'success' => true
            ,'msg' => '전화번호 중복확인 성공'
        ];
        return response()->json($responseData, 200);
    }
}
