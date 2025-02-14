<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardReport;
use App\Models\Comment;
use App\Models\CommentReport;
use App\Models\User;
use App\Models\UserControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserManageController extends Controller
{
    // 유저 리스트 출력
    public function showUserList() {
        // $userList = User::where('manager_flg', '0')
        //                 ->orderBy('created_at', 'DESC')
        //                 ->paginate(15);

        $userList = User::leftJoin('user_controls', 'users.user_id', 'user_controls.user_id')
                        ->where('manager_flg', '0')
                        ->select(
                            'users.user_id',
                            'users.user_flg',
                            'users.user_out',
                            'users.user_email',
                            'users.user_name',
                            'users.user_nickname',
                            'users.created_at',
                            'user_controls.expires_at',
                        )
                        ->orderBy('users.created_at', 'DESC')
                        ->paginate(15);

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userList' => $userList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 유저 상세정보 출력
    public function showUserDetail(Request $request) {
        $userId = $request->id;
        $userDetail = User::where('user_id', $userId)->first();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userDetail' => $userDetail->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 유저가 작성한 게시글 수
    public function showBoardCnt(Request $request) {
        $userId = $request->id;
        $userBoardCnt = Board::
                            select('bc_code', DB::raw('count(*) as cnt'))                    
                            ->where('user_id', $userId)
                            ->groupBy('bc_code')
                            ->get();

        $boardCode = ["0", "1", "2"];
        $newBoardCode = collect($boardCode);
        $userBoardCnt = $newBoardCode->map(function ($code) use ($userBoardCnt) {
            $data = $userBoardCnt->firstWhere('bc_code', $code);
            return [
                'bc_code' => $code,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userBoardCnt' => $userBoardCnt
        ];

        return response()->json($responseData, 200);
    }

    // 유저가 작성한 댓글 수
    public function showCommentCnt(Request $request) {
        $userId = $request->id;
        $userCommentCnt = Comment::where('user_id', $userId)->count();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userCommentCnt' => $userCommentCnt
        ];

        return response()->json($responseData, 200);
    }

    // 유저 제재 이력
    public function showUserControl(Request $request) {
        $userId = $request->id;
        $userControlCnt = UserControl::where('user_id', $userId)->count();
        $userControlExp = UserControl::where('user_id', $userId)->orderBy('created_at', 'DESC')->select('user_id', 'expires_at')->first();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userControlCnt' => $userControlCnt,
            'userControlExp' => $userControlExp,
        ];

        return response()->json($responseData, 200);
    }

    // 유저 상세정보 수정 처리
    public function updateUserDetail(Request $request) {
        try {
            DB::beginTransaction();

            $user = User::find($request->id);
            // Log::debug($user);
            Log::debug('Request:', $request->all());
            
            if($user->user_email !== $request->user_email) {
                // Log::debug($user);
                $user->user_email = $request->user_email;
            }
            if($user->user_name !== $request->user_name) {
                // Log::debug($user);
                $user->user_name = $request->user_name;
            }
            if($user->user_nickname !== $request->user_nickname) {
                // Log::debug($user);
                $user->user_nickname = $request->user_nickname;
            }
            if($user->user_phone !== $request->user_phone) {
                Log::debug($request->user_phone);
                $user->user_phone = $request->user_phone;
            }

            $user->save();

            DB::commit();

            $responseData = [
                'success' => true,
                'msg' => '게시글 수정 성공',
                'user' => $user->toArray()
            ];
        } catch(Throwable $th) {
            DB::rollBack();
            $th->getMessage();
        }

        return response()->json($responseData, 200);
    }

    // 유저 신고당한 게시글
    public function showBoardReport(Request $request) {
        $userId = $request->id;
        $boardReport = BoardReport::join('boards', 'board_reports.board_id', 'boards.board_id')
                                    ->where('boards.user_id', $userId)
                                    ->select(
                                        'board_reports.board_id',
                                        'boards.board_title',
                                        DB::raw("max(boards.created_at) as latest_created_at"),
                                        DB::raw("count(*) as report_count")
                                    )
                                    ->groupBy(
                                        'board_reports.board_id',
                                        'boards.board_title'
                                    )
                                    ->orderBy('latest_created_at', 'DESC')
                                    ->paginate(5);

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'boardReport' => $boardReport
        ];

        return response()->json($responseData, 200);
    }

    // 유저 신고당한 댓글
    public function showCommentReport(Request $request) {
        $userId = $request->id;
        $commentReport = CommentReport::join('comments', 'comment_reports.comment_id', 'comments.comment_id')
                                        ->join('boards', 'comments.board_id', 'boards.board_id')
                                        ->where('comments.user_id', $userId)
                                        ->select(
                                            'comment_reports.comment_id',
                                            'comments.user_id',
                                            'comments.comment_content',
                                            'boards.board_id',
                                            DB::raw("max(comments.created_at) as latest_created_at"),
                                            DB::raw("count(*) as report_cnt")
                                        )
                                        ->groupBy(
                                            'comment_reports.comment_id',
                                            'comments.user_id',
                                            'comments.comment_content',
                                            'boards.board_id',
                                        )
                                        ->orderBy('latest_created_at', 'DESC')
                                        ->paginate(5);

        $responseData = [
            'success' => true,
            'msg' => '댓글 획득 성공',
            'commentReport' => $commentReport
        ];

        return response()->json($responseData, 200);
    }
}
