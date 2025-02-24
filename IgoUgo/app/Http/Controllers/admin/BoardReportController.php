<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\BoardReport;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardReportController extends Controller
{
    public function posts(Request $request) {

        $bcCode =$request->bc_code;

        $boardPost = Board::select(
                                'boards.board_id', 
                                'boards.board_title',
                                'products.contenttypeid',
                                'users.user_name', 
                                'users.user_nickname',
                                'boards.created_at',
                                'boards.board_flg',
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
                                'boards.board_flg',
                            )
                            ->orderBy('boards.created_at', 'DESC')
                            ->paginate(17);
                            
        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userBoardCnt' => $boardPost->toArray()
        ];

        // Log::debug($boardPost);

        return response()->json($responseData, 200);
    }

    public function postDetail(Request $request, $board_id) {

        $bcCode = $request->bc_code;
        // Log::debug($bcCode);
        // Log::debug($board_id);

        // ----------------------------- 경진 start ---------------------------------------------
        $boardPostDetail = Board::select(
                                    'boards.board_id', 
                                    'products.contenttypeid',
                                    'users.user_nickname',
                                    'boards.created_at',
                                    'boards.board_title',
                                    'boards.board_content',
                                    'boards.board_flg',
                                    // 'board_images.board_img',
                                    // DB::raw('count(board_reports.board_id) as report_count'),
                                )
                                ->leftJoin('users', 'boards.user_id', "=", "users.user_id") // 유저 연결
                                ->leftJoin('reviews', 'boards.board_id', '=', 'reviews.board_id') // 프로덕트 연결
                                ->leftJoin('products', 'reviews.product_id', '=', 'products.product_id') // 프로덕트 연결
                                // ->leftJoin('board_reports', 'boards.board_id', '=', 'board_reports.board_id') // 보드리포트 연결
                                // ->leftJoin('board_images', 'boards.board_id', '=', 'board_images.board_id') // 이미지 연결

                                // board_reports, board_images는 hasMany라서 relationship 사용
                                ->with(['board_reports', 'board_images'])
                                ->where('boards.bc_code', $bcCode)
                                ->where('boards.board_id', $board_id)
                                ->groupBy(
                                    'boards.board_id', 
                                    'products.contenttypeid',
                                    'users.user_nickname',
                                    'boards.created_at',
                                    'boards.board_title',
                                    'boards.board_content',
                                    'boards.board_flg',
                                    // 'board_images.board_img',
                                )
                                ->get();
        // ----------------------------- 경진 end ---------------------------------------------
        // Log::debug('test');
        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'boardPostDetail' => $boardPostDetail->toArray()
        ];     

        // Log::debug('BoardPostDetail Query:', $boardPostDetail->toArray());
        
        return response()->json($responseData, 200);
    }

    public function destroyPost($board_id) {
        $boardPostDelete = Board::where('board_flg', '0')
                                ->where('board_id', $board_id)
                                ->update(['board_flg' => '1']);

        $boardImgDelete = BoardImage::where('board_id', $board_id)
                                ->delete();

        
        if ($boardPostDelete > 0 && $boardImgDelete >= 0) {
            $responseData = [
                'success' => true,
                'msg' => '게시글 삭제 성공',
            ];
        } else {
            $responseData = [
                'success' => false,
                'msg' => '삭제할 게시글이 없습니다.',
            ];
        }

        return response()->json($responseData, 200);
    }
}
