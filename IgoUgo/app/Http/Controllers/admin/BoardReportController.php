<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\BoardReport;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardReportController extends Controller
{
    public function posts(Request $request) {

        $bcCode =$request->boardCategory;

        $boardPost = Board::select(
                                'boards.board_id', 
                                'boards.board_title',
                                'products.contenttypeid',
                                'users.user_name', 
                                'users.user_nickname',
                                'boards.created_at',
                                DB::raw('count(board_reports.board_id) as report_count'),
                                )
                                ->leftJoin('board_reports', 'boards.board_id', '=', 'board_reports.board_id')
                                ->leftJoin('users', 'boards.user_id', '=', 'users.user_id')
                                ->leftJoin('reviews', 'boards.board_id', '=', 'reviews.board_id')
                                ->leftJoin('products', 'reviews.product_id', '=', 'products.product_id') 
                            ->where('boards.bc_code', $bcCode)
                            ->groupBy(
                                'boards.board_id', 
                                'boards.board_title', 
                                'products.contenttypeid',
                                'users.user_name', 
                                'users.user_nickname', 
                                'boards.created_at',
                            )
                            ->paginate(17);
                            
        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userBoardCnt' => $boardPost->toArray()
        ];

        // Log::debug($boardPost);

        return response()->json($responseData, 200);
    }

    public function postDetail(Request $request) {

        $bcCode = $request->bc_code;

        $boardPostDetail = Board::select(
                                    'boards.board_id', 
                                    'products.contenttypeid',
                                    'users.user_nickname',
                                    'boards.created_at',
                                    'boards.board_title',
                                    'boards.board_content',
                                    DB::raw('count(board_reports.board_id) as report_count'),
                                )
                                ->leftJoin('users', 'boards.user_id', "=", "users.user_id") // 유저 연결
                                ->leftJoin('reviews', 'boards.board_id', '=', 'reviews.board_id') // 프로덕트 연결
                                ->leftJoin('products', 'reviews.product_id', '=', 'products.product_id') // 프로덕트 연결
                                ->leftJoin('board_reports', 'boards.board_id', '=', 'board_reports.board_id') // 보드리포트 연결
                                ->where('boards.bc_code', $bcCode)
                                ->groupBy(
                                    'boards.board_id', 
                                    'products.contenttypeid',
                                    'users.user_nickname',
                                    'boards.created_at',
                                    'boards.board_title',
                                    'boards.board_content'
                                )
                                ->withTrashed()
                                ->paginate(17);
        Log::debug('test');
        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userBoardCnt' => $boardPostDetail->toArray()
        ];     
        
        return response()->json($responseData, 200);
    }
}
