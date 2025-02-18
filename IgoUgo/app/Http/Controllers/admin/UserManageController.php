<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardReport;
use App\Models\Comment;
use App\Models\CommentReport;
use App\Models\User;
use App\Models\UserControl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserManageController extends Controller
{
    // 유저 리스트 출력
    public function showUserList() {
        $subquery = DB::table('user_controls as uc1')
                        ->select('uc1.user_id', 'uc1.expires_at', 'uc1.created_at')
                        ->whereRaw('uc1.created_at = (
                            select max(uc2.created_at)
                            from user_controls as uc2
                            where uc2.user_id = uc1.user_id
                        )');
        $userList = User::select(
                            'users.user_id',
                            'users.user_email',
                            'users.user_name',
                            'users.user_nickname',
                            'users.user_flg',
                            'users.created_at',
                            'u_control.expires_at',
                            'u_control.created_at as control_created_at'
                        )
                        ->leftJoinSub($subquery, 'u_control', function ($join) {
                            $join->on('users.user_id', 'u_control.user_id');
                        })
                        ->where('users.manager_flg', '0')
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

    // 유저 제재 이력 - 누적 횟수
    public function showUserControl(Request $request) {
        $userId = $request->id;
        $userControlCnt = UserControl::where('user_id', $userId)->withTrashed()->count();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userControlCnt' => $userControlCnt,
        ];

        return response()->json($responseData, 200);
    }

    // 유저 제재 이력 - 만료 일자
    public function showUserControlExp(Request $request) {
        $userId = $request->id;
        $userControlExp = UserControl::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'userControlExp' => ($userControlExp ? $userControlExp->toArray() : []),
        ];

        return response()->json($responseData, 200);
    }

    // 유저 상세정보 수정 처리
    public function updateUserDetail(Request $request) {
        try {
            DB::beginTransaction();

            $user = User::find($request->id);
            Log::debug('Request:', $request->all());
            
            if($user->user_name !== $request->user_name) {
                $user->user_name = $request->user_name;
            }
            if($user->user_nickname !== $request->user_nickname) {
                $user->user_nickname = $request->user_nickname;
            }
            if($user->user_phone !== $request->user_phone) {
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
                                    ->whereIn('boards.bc_code', ['0', '1'])
                                    ->select(
                                        'board_reports.board_id',
                                        'boards.board_title',
                                        'boards.bc_code',
                                        'boards.deleted_at',
                                        DB::raw("max(boards.created_at) as latest_created_at"),
                                        DB::raw("count(*) as report_count")
                                    )
                                    ->groupBy(
                                        'board_reports.board_id',
                                        'boards.board_title',
                                        'boards.bc_code',
                                        'boards.deleted_at'
                                    )
                                    ->withTrashed()
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
                                        ->whereIn('boards.bc_code', ['0', '1'])
                                        ->select(
                                            'comment_reports.comment_id',
                                            'comments.user_id',
                                            'comments.comment_content',
                                            'boards.board_id',
                                            'boards.deleted_at as board_deleted_at',
                                            'comments.deleted_at as comment_deleted_at',
                                            DB::raw("max(comments.created_at) as latest_created_at"),
                                            DB::raw("count(*) as report_cnt")
                                        )
                                        ->groupBy(
                                            'comment_reports.comment_id',
                                            'comments.user_id',
                                            'comments.comment_content',
                                            'boards.board_id',
                                            'board_deleted_at',
                                            'comment_deleted_at'
                                        )
                                        ->withTrashed()
                                        ->orderBy('latest_created_at', 'DESC')
                                        ->paginate(5);

        $responseData = [
            'success' => true,
            'msg' => '댓글 획득 성공',
            'commentReport' => $commentReport
        ];

        return response()->json($responseData, 200);
    }

    // 오늘 유저 현황
    // 신규 가입
    public function showUserSignUpCnt() {
        // $todayDateTime = Carbon::now()->toDateTimeString(); // 오늘 날짜와 시간까지
        // $todayDate = Carbon::today()->toDateString(); // 오늘 날짜만
        $start_date = Carbon::today()->startOfDay(); // 오늘 날짜 00:00:00
        $end_date = Carbon::today()->endOfDay(); // 오늘 날짜 23:59:59

        $today_signup = User::where('manager_flg', '0')
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->count();
        $responseData = [
            'success' => true,
            'msg' => '신규 가입 회원 수 획득 성공',
            'signupCnt' => $today_signup,
        ];

        return response()->json($responseData, 200);
    }
    // 탈퇴 회원
    public function showUserDeleteCnt() {
        $start_date = Carbon::today()->startOfDay(); // 오늘 날짜 00:00:00
        $end_date = Carbon::today()->endOfDay(); // 오늘 날짜 23:59:59

        $today_delete = User::where('manager_flg', '0')
                            ->where('user_flg', '1')
                            ->whereBetween('updated_at', [$start_date, $end_date])
                            ->count();
        $responseData = [
            'success' => true,
            'msg' => '탈퇴 회원 수 획득 성공',
            'deleteCnt' => $today_delete,
        ];

        return response()->json($responseData, 200);
    }
    // 강제 탈퇴 회원
    public function showUserOutCnt() {
        $start_date = Carbon::today()->startOfDay(); // 오늘 날짜 00:00:00
        $end_date = Carbon::today()->endOfDay(); // 오늘 날짜 23:59:59

        $today_out = User::where('manager_flg', '0')
                            ->where('user_out', '1')
                            ->whereBetween('updated_at', [$start_date, $end_date])
                            ->count();
        $responseData = [
            'success' => true,
            'msg' => '강퇴 회원 수 획득 성공',
            'outCnt' => $today_out,
        ];

        return response()->json($responseData, 200);
    }
    // 제재 받은 회원
    public function showUserControlCnt() {
        $start_date = Carbon::today()->startOfDay(); // 오늘 날짜 00:00:00
        $end_date = Carbon::today()->endOfDay(); // 오늘 날짜 23:59:59

        $today_control = UserControl::whereBetween('created_at', [$start_date, $end_date])
                            ->count();
        $responseData = [
            'success' => true,
            'msg' => '제재 받은 회원 수 획득 성공',
            'controlCnt' => $today_control,
        ];

        return response()->json($responseData, 200);
    }

    // 제재 기간 적용
    public function updateUserControl(Request $request) {
        try{
            DB::beginTransaction();
            $insertData['user_id'] = $request->id;
            $insertData['expires_at'] = $request->expires_at;

            $userControl = UserControl::create($insertData);

            if($request->expires_at === '9999-12-31 23:59:59') {
                $user = User::find($request->id);
                $user->user_out = '1';
                $user->save();
            }

            DB::commit();
            
            $responseData = [
                'success' => true,
                'msg' => '회원 제재 기간 등록 성공',
                'userControl' => $userControl->toArray()
            ];
            
            return response()->json($responseData, 200);
        } catch(Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'msg' => '회원 제재 기간 등록 실패',
                'error' => $th->getMessage()
            ], 500);
        }

    }
}
