<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TesterController extends Controller
{
    // 체험단 리스트
    public function index() {
        $testerList = Board::with(['board_category', 'board_images'])
                                ->where('bc_code', '3')
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
        $tester = Board::with(['board_images'])
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
