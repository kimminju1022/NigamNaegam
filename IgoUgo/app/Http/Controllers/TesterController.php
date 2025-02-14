<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TesterController extends Controller
{
    // 체험단 리스트
    public function index() {
        $testerList = Board::with(['board_category', 'board_images'])
                                ->where('bc_code', '3')
                                ->where('board_flg', '0')
                                ->orderBy('created_at','DESC')
                                ->paginate(15);

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 리스트 획득 성공'
            ,'data' => $testerList->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 체험단 디테일
    public function show($id) {
        $tester = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as created_at_timestamps"))
                        ->with(['board_images', 'comments' => function ($query) {
                            $query->select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as created_at_timestamps"))
                            ->with('user');
                        }])
                        ->withCount('comments')
                        ->where('board_id', $id)
                        ->first();
        // $tester = Board::with(['board_images', 'tester_due_dates'])
        //                 ->where('board_id', $id)
        //                 ->first();
        // Log::debug($tester);

        if($tester) {
            $tester->view_cnt += 1;
            $tester->save();
        }
        
        $responseData = [
            'success' => true
            ,'msg' =>'게시글 상세 획득 성공'
            ,'data' => $tester->toArray()
            ,'data' => $tester->toArray()
        ];
        return response()->json($responseData, 200);
    }
}
