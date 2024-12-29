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
            'board_title' => ['required', 'between:1,20', 'regex:/^[0-9a-zA-Z가-힣!@#$%^&*()]+$/'],
            'board_content' => ['required', 'between:1,200', 'regex:/^[0-9a-zA-Z가-힣!@#$%^&*()]+$/'],
            'board_img1' => ['image'],
            'board_img2' => ['image'],
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
