<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BoardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'board_title' => ['required', 'between:1,100', 'regex:/^[0-9a-zA-Z가-힣!@#$%^&*?.,+-_<=>^_{}~() \s]+$/'],
            'board_content' => ['required', 'between:1,2000', 'regex:/^[0-9a-zA-Z가-힣!@#$%^&*?.,+-_<=>^_{}~() \s]+$/'],
            'board_img' => ['array', 'max:5'],
            'board_img.*' => ['image'],
            'bc_code' => ['regex:/^[0-9]{1,2}$/u'],
            'area_code' => ['regex:/^[0-9]{1,2}$/u'],
            // 'bc_code' => ['regex:/^[0-9]{1,2}$/u'], 중복이라 삭제합니당
            'rate' => ['regex:/^[0-5]{1}$/u'],
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false
            ,'msg' => 'insert 유효성 오류'
            ,'data' => $validator->errors()
        ], 422);
        
        throw new HttpResponseException($response);
    }
}
