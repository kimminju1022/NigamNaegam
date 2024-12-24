<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardCategory;
use Illuminate\Http\Request;

// 컨트롤러 이하 모두 에러 상태로 지우거나 주석처리됨 수정예정
class BoardController extends Controller
{
    //action-Method
    public function index(Request $request){
        $boardList = Board::orderBy('created_at','DESC')->paginate(15);
        
        // $type = Board::join('board_categories', 'boards.board_id', '=', 'board_categories.board_id');

        // $boardTitle =Board::join('board_categories'.'boards.bc_id','=','board_categories.bc_name')
        //     ->SELECT (
        //         'board_categories.bc_name')
        //     ->FROM (
        //         'board_categories')
        //     ->JOIN ('boards')
        //     ->ON( 'board_categories.bc_id','=','boards.bc_id'
        //     );
        $boardTitle = BoardCategory::select('bc_name')
                        ->where('bc_type', '=', $request->bc_type)
                        ->first();

        $responseData = [
            'success' => true
            ,'boardTitle'=> $boardTitle
            ,'msg' =>'게시글획득성공'
            ,'boardTitle' => $boardTitle->bc_name
            ,'boardList' => $boardList->toArray()
        ];
        
        // type검증
        // if(!array_key_exists($type, $data)){
        //     return response()->json(['error' => 'type검증'], 400);
        // }
        return response()->json($responseData, 200);
        return $data[$type];
    }
    // 조인할 쿼리문 짜기
    // public function show($id){
    //     $board = Board::join('users', 'boards.user_id', '=', 'users.user_id')
    //     ->select(
    //         'boards.board_id',
    //         'boards.user_id',
    //         'boards.board_title',
    //         'boards.created_at',
    //         'boards.view_cnt',
    //         // 'likes.',
    //         'users.user_nickname'
    //         )
    //     ->orderBy(
    //         'boards.created_at', 'DESC'
    //     )
    //     ->where(
    //         'board_categories.bc_type', '='
    //         )
    //     ->first();
    // }

    // public function showMyQuestion(Request $request){

    //     $questionList = Board::with('users')
    //     ->orderBy('created_at', 'DESC')
    //                             ->where('user_id', $request->user_id)
    //                             // ->with('users')
    //                             // ->paginate(5);
    //                             ->get();

    //     $responseData = [
    //         'success' => true
    //         ,'msg' =>' 유저의 문의게시글 획득 성공'
    //         ,'data' => $questionList->toArray()
    //     ];

    //     return response()->json($responseData, 200);
    // }
}