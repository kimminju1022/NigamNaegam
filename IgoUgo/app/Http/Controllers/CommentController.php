<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MyToken;
use Throwable;

class CommentController extends Controller
{
    // ------------------------- meerkat Start -------------------------
    // 댓글 목록
    public function boardIndex(Request $request) {
        $comments = Comment::with('user')
                        ->where('comments.board_id', '=', $request->board_id)
                        ->orderBy('created_at','ASC')
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
    public function boardStore(CommentRequest $request) {
        // 토큰비교
        $userId = MyToken::getValueInPayload($request->bearerToken(), 'idt');
    
        // 댓글 입력
        $insertData = [
            'comment_content' =>$request->comment_content,
            'board_id' => $request->board_id,
            'user_id' => $userId
        ];
    
        // 댓글 저장
        $comment = Comment::create($insertData);
        $comment->load('user');
    
        $responseData = [
            'success' => true,
            'msg' => '댓글 작성 성공',
            'comment' => $comment->toArray(),
        ];
    
        return response()->json($responseData, 200);
    }

    // 댓글 삭제
    public function boardDestroy($id) {
        $comment = Comment::destroy($id);
        
        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }

    // 댓글 신고
    public function boardCommentReport(Request $request, $id) {
        // responseData 초기화
        $responseData = [
            'success' => true
            ,'msg' => ''
        ];

        $userId = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        // 신고 정보 저장
        try {
            DB::beginTransaction();

            // 중복 신고 방지 체크
            $existingReport = CommentReport::where('comment_report_id', $id)
                ->where('user_id', $userId)
                ->exists();
            
            if(!$existingReport) {
                $report = new CommentReport();
                $report->comment_id = $id;
                $report->user_id = $userId;
                $report->save();
            }

            DB::commit();
            $responseData['success'] = true;
            $responseData['msg'] = '신고가 접수되었습니다.';
        } catch(Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // 성공 응답
        return response()->json($responseData, 200);
    }
    // ------------------------- meerkat End -------------------------

    // -----------------------------------------------------------------------------------------------
    // 경진
    // 관리자 체험단 댓글 리스트
    public function index($id) {
        $commentList = Comment::with('user')
                                ->where('board_id', $id)
                                ->orderBy('created_at','DESC')
                                ->paginate(10);

        $responseData = [
            'success' => true
            ,'msg' =>'댓글 리스트 획득 성공'
            ,'data' => $commentList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 체험단 댓글 작성
    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $insertData = $request->only('comment_content');
            $insertData['board_id'] = $request->board_id;
            $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');

            $comment = Comment::create($insertData);
            $comment->load('user');

            $responseData = [
                'success' => true
                ,'msg' => '게시글 작성 성공'
                ,'data' => $comment->toArray()
            ];

            DB::commit();
            
            return response()->json($responseData, 200);
        } catch(Throwable $th){
            DB::rollBack();
            $th->getMessage();
        }
    }

    // 게시글 삭제
    public function destroy($id) {
        Log::debug($id);
        $comment = Comment::find($id);
                
        $comment->delete();
        
        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }
}