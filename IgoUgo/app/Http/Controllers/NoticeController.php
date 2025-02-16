<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    // 공지사항 리스트
    public function index() {
        $notice = Board::where('bc_code', '5')
                        ->where('board_flg', '0')
                        ->orderBy('created_at','DESC')
                        ->paginate(10);

        $responseData = [
        'success' => true
        ,'msg' =>'게시글 리스트 획득 성공'
        ,'data' => $notice->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 공지사항 TOP 리스트
    public function topList() {
        $notice = Board::where('bc_code', '5')
                        ->where('board_flg', '0')
                        ->orderBy('created_at','DESC')
                        ->paginate(5);

        $responseData = [
        'success' => true
        ,'msg' =>'게시글 top 리스트 획득 성공'
        ,'data' => $notice->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 공지사항 디테일
    public function show($id) {
        $notice= Board::with(['user', 'board_images'])
                        ->where('board_id', $id)
                        ->first();

        if ($notice) {
            $notice->view_cnt += 1;
            $notice->save();
        }

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $notice->toArray()
        ];
        return response()->json($responseData, 200);
    }
}
