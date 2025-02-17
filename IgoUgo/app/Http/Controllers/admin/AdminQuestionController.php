<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AdminQuestionController extends Controller
{
    // 관리자 -------------------------------------------------------------
    // 메인페이지 답변대기 리스트
    public function adminQuestionYet() {
        $questionList = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at_timestamps"))
                                ->with(['question', 'user', 'question_category'])
                                ->whereHas('question', function ($query) {
                                    $query->where('que_status', '0');
                                })
                                ->where('bc_code', '2')
                                ->where('board_flg', '0')
                                ->orderBy('created_at','DESC')
                                ->paginate(5);

        $responseData = [
            'success' => true
            ,'msg' =>'답변대기 리스트 획득 성공'
            ,'data' => $questionList->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 메인페이지 답변완료 리스트
    public function adminQuestionDone() {
        $questionList = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at_timestamps"))
                                ->with(['question' => function ($query) {
                                    $query->select(DB::raw("*, DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') as updated_at_timestamps"))
                                            ->with('user');
                                    $query->where('que_status', '1');
                                }, 'user', 'question_category'])
                                ->whereHas('question', function ($query) {
                                    $query->where('que_status', '1');
                                })
                                ->where('bc_code', '2')
                                ->where('board_flg', '0')
                                // ->orderBy('created_at','DESC')
                                ->paginate(5);

        $responseData = [
            'success' => true
            ,'msg' =>'답변완료 리스트 획득 성공'
            ,'data' => $questionList->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 관리자 문의게시판 디테일
    public function showQuestionDetail($id) {
        $question = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at_timestamps"))
                                // ->with(['question', 'user', 'board_images', 'question_category'])
                                ->with(['question' => function ($query) {
                                    $query->select(DB::raw("*, DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') as updated_at_timestamps"))
                                            ->with('user');
                                }, 'user', 'board_images', 'question_category'])
                                ->where('board_id', $id)
                                ->first();

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $question->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 관리자 답변 작성
    public function storeQuestion(Request $request, $id) {
        try {
            DB::beginTransaction();
            // Log::debug('request', $request->all());
            $question = Question::where('board_id', $id)->first();
            // Log::debug('question : ', $question->toArray());

            if(!$question) {
                $responseData = [
                    'success' => false
                    ,'msg' => '답변 획득 실패'
                ];
            }

            if($question->que_content !== $request->que_content) {
                $question->que_content = $request->que_content;
            }

            // 관리자 정보 받아야함
            if($question->user_id !== $request->user_id) {
                $question->user_id = $request->user_id;
            }

            $question->que_status = '1';

            $question->save();

            DB::commit();
            
            $responseData = [
                'success' => true
                ,'msg' => '답변 업데이트 성공'
                ,'question' => $question->toArray()
            ];
            
            return response()->json($responseData, 200);
        } catch(Throwable $th){
            DB::rollBack();
            $th->getMessage();
        }
    }
}
