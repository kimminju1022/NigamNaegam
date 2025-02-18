<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentReportController extends Controller
{
    public function showCommentList() {
        $commentList = Comment::join('users', 'comments.user_id', 'users.user_id')
                                ->join('comment_reports', 'comments.comment_id', 'comment_reports.comment_id')
                                ->join('boards', 'comments.board_id', 'board.board_id')
                                ->whereIn('boards.bc_code', ['0', '1'])
                                ->select(
                                    'comments.comment_id',
                                    'boards.board_id',

                                );
    }
}
