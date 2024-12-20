<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //action-Method
    public function index(){
        $boardList = Question::orderBy('created_at','DESC')->paginate(20);

        $responseData = [
            'success' => true,'msg' =>'게시글획득성공'
            ,'boardList' => $boardList->toArray()
        ];
        return response()->json($responseData, 200);
    }
}
