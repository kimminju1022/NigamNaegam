<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    // 문의게시판 index 페이지
    public function index(){
        $bcType = '2';
        $questionList = Board::with(['questions', 'users', 'board_categories'])
                                ->where('bc_type', $bcType)
                                ->orderBy('created_at','DESC')
                                ->paginate(15);

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $questionList->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 문의게시판 디테일
    public function show($id) {
        $bcType = '2';
        $questionList = Board::with(['questions', 'users', 'board_categories'])
                                ->where('board_id', $id)
                                ->where('bc_type', $bcType)
                                ->first();
                                
        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $questionList->toArray()
        ];
        return response()->json($responseData, 200);
    }
    
    // 유저 1:1 문의 내역
    public function showMyQuestion($id){
        $bcType = '2';
        $questionList = Board::with(['questions', 'users', 'board_categories'])
                                ->where('user_id', $id)
                                ->where('bc_type', $bcType)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        // foreach($questionList as $item) {
        //     $item->created_at = Carbon::parse($item->create_at)->format('Y-m-d');
        //     return $item;
        // }

        $responseData = [
            'success' => true
            ,'msg' =>' 유저의 문의게시글 획득 성공'
            ,'data' => $questionList->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
