<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentReportController extends Controller
{
    // 댓글 리스트
    public function showCommentList() {
        $commentList = Comment::join('users', 'comments.user_id', 'users.user_id')
                                ->leftJoin('comment_reports', 'comments.comment_id', 'comment_reports.comment_id')
                                ->join('boards', 'comments.board_id', 'boards.board_id')
                                ->whereIn('boards.bc_code', ['0', '1'])
                                ->select(
                                    'comments.comment_id',
                                    'boards.board_id',
                                    'boards.board_flg',
                                    'boards.deleted_at',
                                    'comments.comment_content',
                                    'users.user_name',
                                    'users.user_nickname',
                                    'comments.created_at',
                                    'comments.comment_flg',
                                    DB::raw("COUNT(comment_reports.comment_id) as report_cnt")
                                )
                                ->groupBy(
                                    'comments.comment_id',
                                    'boards.board_id',
                                    'boards.board_flg',
                                    'boards.deleted_at',
                                    'comments.comment_content',
                                    'users.user_name',
                                    'users.user_nickname',
                                    'comments.created_at',
                                    'comments.comment_flg'
                                )
                                ->whereNull('boards.deleted_at')
                                ->orderBy('comments.created_at', 'DESC')
                                ->paginate(17);

        $responseData = [
            'success' => true,
            'msg' => '댓글 획득 성공',
            'commentList' => $commentList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 댓글 상세
    public function showCommentDetail(Request $request) {
        $commentId = $request->commentid;
        $commentDetail = Comment::join('users', 'comments.user_id', 'users.user_id')
                                ->leftJoin('comment_reports', 'comments.comment_id', 'comment_reports.comment_id')
                                ->join('boards', 'comments.board_id', 'boards.board_id')
                                ->select(
                                    'boards.board_id',
                                    'boards.board_title',
                                    'boards.bc_code',
                                    'comments.comment_id',
                                    'comments.comment_flg',
                                    'comments.comment_content',
                                    'users.user_nickname',
                                    'comments.created_at',
                                    DB::raw("COUNT(comment_reports.comment_id) as report_cnt")
                                )
                                ->groupBy(
                                    'boards.board_id',
                                    'boards.board_title',
                                    'boards.bc_code',
                                    'comments.comment_id',
                                    'comments.comment_flg',
                                    'comments.comment_content',
                                    'users.user_nickname',
                                    'comments.created_at'
                                )
                                ->where('comments.comment_id', $commentId)
                                ->first();

        $responseData = [
            'success' => true,
            'msg' => '게시글 획득 성공',
            'commentDetail' => $commentDetail->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 댓글 삭제
    public function destroyComment($comment_id) {
        $commentDelete = Comment::where('comment_flg', '0')
                                ->where('comment_id', $comment_id)
                                ->update(['comment_flg' => '1']);

        if ($commentDelete > 0) {
            $responseData = [
                'success' => true,
                'msg' => '댓글 삭제 성공',
            ];
        } else {
            $responseData = [
                'success' => false,
                'msg' => '삭제할 댓글이 없습니다.',
            ];
        }

        return response()->json($responseData, 200);
    }
}
