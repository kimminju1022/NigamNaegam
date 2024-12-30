<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardCategory;
use App\Models\Comment;
use Database\Seeders\AreaSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// 컨트롤러 이하 모두 에러 상태로 지우거나 주석처리됨 수정예정
class BoardController extends Controller
{
    // action-Method

    public function index(Request $request) {
        $boardList = Board::
            join('users', 'users.user_id', '=', 'boards.user_id')
            ->when($request->bc_type === '0', function(Builder $query) {
                return $query->join('reviews', function ($join) {
                        $join->on('reviews.board_id', '=', 'boards.board_id')
                            ->where('boards.bc_type', '=', '0');
                    })
                    ->join('areas', 'areas.area_code', '=', 'reviews.area_code')
                    ->joinSub(
                        DB::table('likes')
                            ->select('likes.board_id', DB::raw('COUNT(likes.like_id) as like_cnt'))
                            ->where('like_flg', '=', '1')
                            ->groupBy('likes.board_id'),
                        'like_tmp',
                        'boards.board_id',
                        '=',
                        'like_tmp.board_id'
                    );
            })
            ->orderBy('boards.created_at', 'desc')
            ->paginate(15);

            $boarCategoryBctype = board::
            join('reviews','reviews.area_code','=','areas.area_code');
            
                
        // 보드 타이틀 획득
        $boardTitle = BoardCategory::select('bc_name')
                        ->where('bc_type', '=', $request->bc_type)
                        ->first();
        // 게시물정보 획득득
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
        

    public function show($id){
        // $comment = Board::with('comment')->get();
        // $data = [];
        // $comment = Comment::get();
        $board = Board::with('comments.user')->find($id);


        // foreach($comment as $item){
        //     $temp = $item->toArray();
        //     $comment = Comment::where('board_id', $item->board_id)->get();
        //     $temp['comments'] = $comment->toArray();
        //     $data[] = $temp;
        // }
        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            ,'board' => $board->toArray()
        ];
        return response()->json($responseData, 200);
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