<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'user_email' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z\-]+@[a-z]+\.[a-z\-]+$/']
            ,'user_password' => ['required', 'between:5,20', 'regex:/^(?=.*?[A-Za-z])(?=.*?[0-9])(?=.*?[!@#$%^&*]).{5,}$/']
        ];

        // 로그인
        if($this->routeIs('auth.login')) {
            $rules['user_email'][] = 'exists:users,user_email';
        }
        
        // 회원가입
        else if($this->routeIs('user.store')) {
            $rules['user_email'][] = 'unique:users,user_email';
            $rules['user_password_chk'] = ['same:user_password'];
            $rules['user_name'] = ['required', 'between:2, 20', 'regex:/^[a-zA-Z가-힣]+$/u'];

            // unique?
            $rules['user_nickname'] = ['required', 'between:1, 50', 'unique:users,user_nickname', 'regex:/^[0-9a-zA-Z가-힣]+$/u'];
            $rules['user_phone'] = ['required', 'between:11,15', 'unique:users,user_phone', 'regex:/^[0-9]+$/u'];
        }
        
        // 유저 업데이트
        else if($this->routeIs('user.update')) {
            $rules['user_name'] = ['required', 'between:2,20', 'regex:/^[a-zA-Z가-힣]+$/u'];
            $rules['user_nickname'] = ['required', 'between:1,50', 'regex:/^[0-9a-zA-Z가-힣]+$/u'];
            $rules['user_phone'] = ['required', 'between:11,15', 'regex:/^[0-9]+$/u'];
            // $rules['user_profile'] = ['required', 'between:11,15', 'regex:/^[0-9]+$/u'];

            unset($rules['user_email']);
            unset($rules['user_password']);
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator) {
        $response = response()->json([
            'success' => false,
            'message' => '유효성 체크 오류',
            'data' => $validator->errors()
        ], 422);
    
        throw new HttpResponseException($response);
    } 
}
