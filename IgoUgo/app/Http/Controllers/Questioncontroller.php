<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function showMyQuestion(Request $request){

        Log::debug($request);
        $questionList = Board::with(['questions', 'users', 'board_categories'])
                                ->where('user_id', $request->user_id)
                                ->Where('bc_type', $request->bc_type)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);




        $responseData = [
            'success' => true
            ,'msg' =>' 유저의 문의게시글 획득 성공'
            ,'data' => $questionList->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
