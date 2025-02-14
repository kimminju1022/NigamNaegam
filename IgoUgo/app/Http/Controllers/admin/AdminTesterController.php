<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTesterController extends Controller
{
    // 체험단 리스트
    public function index() {
        $testerList = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as created_at_timestamps"))
                                ->with(['board_category', 'board_images', 'user'])
                                ->where('bc_code', '3')
                                ->where('board_flg', '0')
                                ->withCount('comments')
                                ->orderBy('created_at','DESC')
                                ->paginate(17);

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 리스트 획득 성공'
            ,'data' => $testerList->toArray()
        ];
        return response()->json($responseData, 200);
    }
}
