<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class TesterController extends Controller
{
    public function index() {
        $testerList = Board::with('board_category')
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
}
