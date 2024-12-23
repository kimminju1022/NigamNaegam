<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Illuminate\Http\Request;

// 컨트롤러 이하 모두 에러 상태로 지우거나 주석처리됨 수정예정
class BoardController extends Controller
{
    //action-Method
    public function index($type){
        // $boardList = BoardsCategory::orderBy('created_at','DESC')->paginate(15);
        
        $type = Board::join('boards_category', 'boards.board_id', '=', 'boards_category.board_id');

        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            // ,'boardList' => $boardList->toArray()
        ];
        $data =[
            '리뷰' => [
                'board_name' => '리뷰게시판',
                'list' => ['board_id','area_code']
            ]
            ,'자유' => [
                'board_name' => '자유게시판',
                'list' => ['board_id','area_code']
            ]
        ];
        // type검증
        if(!array_key_exists($type, $data)){
            return response()->json(['error' => 'type검증'], 400);
        }
        return response()->json($responseData, 200);
        return $data[$type];
    }
    // 조인할 쿼리문 짜기
    public function show($id){
        $board = Board::join('users', 'boards.user_id', '=', 'users.user_id')
        ->select(
            'boards.board_id',
            'boards.user_id',
            'boards.board_title',
            'boards.created_at',
            'boards.view_cnt',
            // 'likes.',
            'users.user_nickname'
            )
        ->orderBy(
            'boards.created_at', 'DESC'
        )
        ->where(
            'board_categories.bc_type', '='
            )
        ->first();
    }

}