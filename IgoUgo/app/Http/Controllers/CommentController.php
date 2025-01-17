<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentReport;
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

    // 댓글 신고
    public function commentReport(Request $request)
    {
    // 1. 클라이언트로부터 받는 데이터 (예: comment_id, 신고 사유, 유저 ID 등)
        $commentRId = $request->comment_id; // 신고할 댓글 ID
        $userId = auth()->id();           // 로그인된 사용자 ID

        // 2. 중복 신고 방지 체크
        $existingReport = CommentReport::where('comment_report_id', $commentRId)
                                ->where('user_id', $userId)
                                ->first();
        if ($existingReport) {
            return response()->json([
                'success' => false,
                'msg' => '이미 신고한 댓글입니다.'
            ], 400);
        }

        // 3. 댓글 존재 여부 확인
        $comment = Comment::find($commentRId);
        if (!$comment) {
            return response()->json([
                'success' => false,
                'msg' => '존재하지 않는 댓글입니다.'
            ], 404);
        }

        // 4. 신고 정보 저장
        $report = new CommentReport();
        $report->comment_id = $commentRId;
        $report->user_id = $userId;
        $report->save();

        // 5. 성공 응답
        return response()->json([
            'success' => true,
            'msg' => '신고가 접수되었습니다.'
            ], 201);
    }
}