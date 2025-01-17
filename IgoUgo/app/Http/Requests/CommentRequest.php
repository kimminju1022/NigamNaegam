<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
                'comment_content' => ['required', 'string','max:500'],
                'board_id' => ['required', 'integer', 'exists:boards,board_id']
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false
            ,'msg' => 'Comment 유효성 오류'
            ,'data' => $validator->errors()
        ], 422);
        
        throw new HttpResponseException($response);
    }
}
