<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserManageController extends Controller
{
    public function getUserList() {
        $userList = User::where('manager_flg', '0')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15);

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userList' => $userList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function getUserDetail(Request $request) {
        $userId = $request->id;
        $userDetail = User::where('user_id', $userId)->first();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userDetail' => $userDetail->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function getBoardCnt(Request $request) {
        $userId = $request->id;
        $userBoardCnt = Board::
                            select('bc_code', DB::raw('count(*) as cnt'))                    
                            ->where('user_id', $userId)
                            ->groupBy('bc_code')
                            ->get();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userBoardCnt' => $userBoardCnt
        ];

        return response()->json($responseData, 200);
    }
}
