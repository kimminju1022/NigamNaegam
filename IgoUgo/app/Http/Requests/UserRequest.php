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
            'email' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z\-]+@[a-z]+\.[a-z\-]+$/']
            ,'password' => ['required', 'between:5,20', 'regex:/^(?=.*?[A-Za-z])(?=.*?[0-9])(?=.*?[!@#$%^&*]).{5,}$/']
        ];

        // 로그인
        if($this->routeIs('auth.login')) {
            $rules['email'][] = 'exists:users,user_email';
        }
        
        // 회원가입
        else if($this->routeIs('user.store')) {
            $rules['email'][] = 'unique:users,user_email';
            $rules['password_chk'] = ['same:password'];
            $rules['name'] = ['required', 'between:2, 20', 'regex:/^[a-zA-Z가-힣]+$/u'];
            // $rules['nickname'] = ['required', 'between:1, 50', 'regex:/^[0-9a-zA-Z가-힣]+$/u'];
            // $rules['phone'] = ['required', 'between:11,15', 'regex:/^[0-9]+$/u'];

            // unique?
            $rules['nickname'] = ['required', 'between:1, 50', 'unique:users,user_nickname', 'regex:/^[0-9a-zA-Z가-힣]+$/u'];
            $rules['phone'] = ['required', 'between:11,15', 'unique:users,user_phone', 'regex:/^[0-9]+$/u'];
        }
        

        // 유저 업데이트
        else if($this->routeIs('user.update')) {
            $rules['name'] = ['required', 'between:2, 20', 'regex:/^[a-zA-Z가-힣]+$/u'];
            $rules['nickname'] = ['required', 'between:1, 50', 'unique:users,user_nickname', 'regex:/^[0-9a-zA-Z가-힣]+$/u'];
            $rules['phone'] = ['required', 'between:11,15', 'unique:users,user_phone', 'regex:/^[0-9]+$/u'];

            unset($rules['email']);
            unset($rules['password']);
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
