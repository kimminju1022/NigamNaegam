<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use MyToken;

class CommentController extends Controller
{
    // 댓글 목록
    public function index(Request $request) {
        $comments = Comment::select('comments.comment_id', 'comments.comment_content' ,'comments.created_at' ,'users.user_nickname')
                        ->join('users', 'users.user_id', '=', 'comments.user_id')
                        ->where('comments.board_id', '=', $request->board_id)
                        ->paginate(10); //10개마다 페이지네이션하기
                        // ->get()
                        // ->map(function ($comment) {
                        //     $comment->created_at = Carbon::parse($comment->created_at)->format('y:m:d');
                        //     return $comment;
                        // });
        $responseData = [
            'success' => true
            ,'msg' => ' 코멘트 리스트 획득 성공'
            ,'comments' => $comments->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 댓글 작성
    public function store(CommentRequest $request) {
        // 토큰비교
        $userId = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        if (!$userId) {
            throw new MyAuthException('E24');
        }
    
        // 댓글 입력
        $insertData = [
            'comment_content' =>$request->comment_content,
            'board_id' => $request->board_id,
            'user_id' => $userId
        ];
    
        // 댓글 저장
        $comment = Comment::create($insertData);
    
        $responseData = [
            'success' => true,
            'msg' => '댓글 작성 성공',
            'comment' => $comment->toArray(),
        ];
    
        return response()->json($responseData, 200);
    }

    // 댓글 삭제
    public function destroy($id) {
        $comment = Comment::destroy($id);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }


}