<?php

namespace App\Http\Controllers;

use App\Models\Comment;
// use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request) {
        $comments = Comment::select('comments.comment_id', 'comments.comment_content' ,'comments.created_at' ,'users.user_nickname')
                        ->join('users', 'users.user_id', '=', 'comments.user_id')
                        ->where('comments.board_id', '=', $request->board_id)
                        ->paginate(5);
                        // ->get()
                        // ->map(function ($comment) {
                        //     $comment->created_at = Carbon::parse($comment->created_at)->format('y:m:d');
                        //     return $comment;
                        // });
        $responseData = [
            'success' => true
            ,'msg' => ' 코멘트 리스트 획득 성공공'
            ,'comments' => $comments->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
