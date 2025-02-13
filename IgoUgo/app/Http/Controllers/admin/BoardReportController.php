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
                                'products.area_code',
                                'users.user_name', 
                                'users.user_nickname',
                                'boards.created_at',
                                DB::raw('count(board_reports.board_id) as report_count'),
                                )
                                ->leftJoin('board_reports', 'boards.board_id', '=', 'board_reports.board_id')
                                ->leftJoin('users', 'boards.user_id', '=', 'users.user_id')
                                ->leftJoin('reviews', 'boards.board_id', '=', 'reviews.board_id')
                                ->leftJoin('products', 'reviews.product_id', '=', 'products.product_id') 
                            ->whereNull('boards.deleted_at')
                            ->where('boards.bc_code', $bcCode)
                            ->groupBy(
                                'boards.board_id', 
                                'boards.board_title', 
                                'products.area_code',
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

    // public function postDetail(Request $request) {
    //     $boardPostDetail = Board::select(
    //                                 'boards'
    //     )
    // }
}
