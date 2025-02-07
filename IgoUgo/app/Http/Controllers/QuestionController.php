<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Models\BoardImage;
use MyToken;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Throwable;

class QuestionController extends Controller
{
    // 문의게시판 index 페이지
    public function index(){
        $bc_code = '2';
        $questionList = Board::with(['question', 'user', 'board_category'])
                                // ->where('bc_type', $bcType)
                                ->where('bc_code', $bc_code)
                                ->orderBy('created_at','DESC')
                                ->paginate(15);

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 리스트 획득 성공'
            ,'data' => $questionList->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 문의게시판 디테일
    public function show($id) {
        $question = Board::with(['question', 'user', 'board_images', 'question_category'])
                                ->where('board_id', $id)
                                ->first();
        // $question = Board::with(['questions', 'users', 'board_categories'])
        //                         ->where('board_id', $id)
        //                         ->first();

        if ($question) {
            $question->view_cnt += 1;
            $question->save();
        }

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $question->toArray()
        ];
        return response()->json($responseData, 200);
    }
    
    // 유저 1:1 문의 내역
    public function showMyQuestion($id){
        // $bcType = '2';
        $questionList = Board::with(['question', 'user', 'board_category'])
                                ->where('user_id', $id)
                                // ->where('bc_type', $bcType)
                                ->where('bc_code', '2')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        // Log::debug($questionList);

        $responseData = [
            'success' => true
            ,'msg' =>' 유저의 문의게시글 획득 성공'
            ,'data' => $questionList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 게시글 작성
    public function store(BoardRequest $request) {
        try {
            DB::beginTransaction();
            $insertData = $request->only('board_title','board_content');
            $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
            $insertData['view_cnt'] = 0;
            // $insertData['bc_type'] = 2;
            $insertData['bc_code'] = 2;

            $board = Board::create($insertData);
            
            // 이미지 테이블 분리 전 작업
            // if ($request->hasFile('board_img1')) {
            //     $insertData['board_img1'] = '/'.$request->file('board_img1')->store('img');
            // } else {
            //     $insertData['board_img1'] = '/default/board_default.png';
            // }

            // if ($request->hasFile('board_img2')) {
            //     $insertData['board_img2'] = '/'.$request->file('board_img2')->store('img');
            // } else {
            //     $insertData['board_img2'] = '/default/board_default.png';
            // }

            // 이미지 테이블 분리 후 작업
            if($request->hasFile('board_img')) {
                foreach ($request->board_img as $file) {
                    $path = '/'.$file->store('img');
                    BoardImage::create([
                        'board_id' => $board->board_id,
                        'board_img' => $path,
                    ]);
                }
            }

            // 카테고리 선택
            $insertCategory['board_id'] = $board->board_id;
            $insertCategory['qc_code'] = $request->qc_code;
            $insertCategory['qc_name'] = $request->qc_name;

            $questionCategory = QuestionCategory::create($insertCategory);

            // 관리자 답변 생성
            $insertQuestion['board_id'] = $board->board_id;
            $insertQuestion['user_id'] = '1';
            $insertQuestion['que_content'] = null;
            $insertQuestion['que_status'] = 0;

            $question = Question::create($insertQuestion);

            $responseData = [
                'success' => true
                ,'msg' => '게시글 작성 성공'
                ,'board' => $board->toArray()
                ,'question' => $question->toArray()
                // ,'data' => $question->toArray()
                ,'category' => $questionCategory->toArray()
            ];

            DB::commit();
            
            return response()->json($responseData, 200);
        } catch(Throwable $th){
            DB::rollBack();
            $th->getMessage();
        }
    }

    // 게시글 수정페이지 이동
    public function edit($id) {
        $board = Board::find($id);
    
        $responseData = [
            'success' => true
            ,'msg' => '게시글 획득 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 게시글 수정 처리
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            // Log::debug('수정 시작');
            
            $board = Board::find($request->board_id);
            // Log::debug($board);
    
            if($board->board_title !== $request->board_title) {
                $board->board_title = $request->board_title;
            }
            if($board->board_content !== $request->board_content) {
                $board->board_content = $request->board_content;
            }
    
            $board->save();
    
            // 이미지 테이블 분리 전 작업
            // if($request->hasFile('board_img1') && $request->file('board_img1')->isValid()) {
            //     $path = '/'.$request->file('board_img1')->store('img');
            //     $board->board_img1 = $path;
            // }
            // if($request->hasFile('board_img2') && $request->file('board_img2')->isValid()) {
            //     $path = '/'.$request->file('board_img2')->store('img');
            //     $board->board_img2 = $path;
            // }
            
            
            // 이미지 테이블 분리 후 작업
            $boardImg = BoardImage::where('board_id', $request->board_id)->get();
            // Log::debug('boardImage : ',$boardImg->toArray());

            // Log::debug($request->board_img_path);
            // Log::debug($request->board_img_file);

            // 이미 있던 이미지 request
            if ($request->has('board_img_path')) {
                foreach ($boardImg as $image) {
                    // 현재 board_img가 request에 없으면 softDelete
                    if (!in_array($image->board_img, $request->board_img_path)) {
                        $image->deleted_at = now();
                        $image->save();
                    }
                }
            }

            // 새로 추가한 이미지 request
            if ($request->has('board_img_file')) {
                foreach ($request->board_img_file as $file) {
                    $path = '/'.$file->store('img');
                    BoardImage::create([
                        'board_id' => $request->board_id
                        ,'board_img' => $path
                        ,'deleted_at' => null,      
                    ]);
                }
            }

            $questionCategory = QuestionCategory::where('board_id',$request->board_id)->first();
            // Log::debug($questionCategory);
    
            if($questionCategory->qc_code !== $request->qc_code) {
                $questionCategory->qc_code = $request->qc_code;
            } 
            if($questionCategory->qc_name !== $request->qc_name) {
                $questionCategory->qc_name = $request->qc_name;
            } 
    
            $questionCategory->save();
            // Log::debug('수정 끝');
    
            DB::commit();

            $responseData = [
                'success' => true
                ,'msg' => '게시글 업데이트 성공'
                ,'board' => $board->toArray()
                ,'board_img' => $boardImg->toArray()
            ];
        } catch(Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($responseData, 200);
    }

    // 게시글 삭제
    public function destroy($id) {
        $board = Board::with('question')
                        ->find($id);

        // $board->delete();
        $board->board_flg = '1';

        $board_img = BoardImage::with('board')
                                ->where('board_id', $id)
                                ->first();
                
        $board_img->delete();
        
        $question = Question::with('board')
                            ->where('board_id', $id)
                            ->first();

        $question->que_flg = '1';

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }
}
