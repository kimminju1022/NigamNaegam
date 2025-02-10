<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
