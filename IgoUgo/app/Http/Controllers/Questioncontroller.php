<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use MyToken;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class QuestionController extends Controller
{
    // 문의게시판 index 페이지
    public function index(){
        $bcType = '2';
        $questionList = Board::with(['questions', 'users', 'board_categories'])
                                ->where('bc_type', $bcType)
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
        $question = Board::with(['questions', 'users'])
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
        // Log::debug('showMyQuestion', $id);
        $bcType = '2';
        $questionList = Board::with(['questions', 'users', 'board_categories'])
                                ->where('user_id', $id)
                                ->where('bc_type', $bcType)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        // foreach($questionList as $item) {
        //     $item->created_at = Carbon::parse($item->create_at)->format('Y-m-d');
        //     return $item;
        // }
        
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
        $insertData = $request->only('board_title','board_content');
        $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        $insertData['view_cnt'] = 0;
        $insertData['bc_type'] = 2;

        if ($request->hasFile('board_img1')) {
            $insertData['board_img1'] = $request->file('board_img1')->store('img');
        } else {
            $insertData['board_img1'] = '/default/board_default.png';
        }

        if ($request->hasFile('board_img2')) {
            $insertData['board_img2'] = $request->file('board_img2')->store('img');
        } else {
            $insertData['board_img2'] = '/default/board_default.png';
        }

        $board = Board::create($insertData);

        $insertQuestion['board_id'] = $board->board_id;
        $insertQuestion['que_content'] = null;
        $insertQuestion['que_status'] = 0;

        $question = Question::create($insertQuestion);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 작성 성공'
            ,'board' => $board->toArray()
            ,'data' => $question->toArray()
        ];

        return response()->json($responseData, 200);
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
    public function update(BoardRequest $request) {
        Log::debug('q_update', $request->all());
        $board = Board::find($request->board_id);

        if($board->board_title !== $request->board_title) {
            $board->board_title = $request->board_title;
        }
        if($board->board_content !== $request->board_content) {
            $board->board_content = $request->board_content;
        }
        if($request->hasFile('board_img1') && $request->file('board_img1')->isValid()) {
            $path = '/'.$request->file('board_img1')->store('img');
            $board->board_img1 = $path;
        }
        if($request->hasFile('board_img2') && $request->file('board_img2')->isValid()) {
            $path = '/'.$request->file('board_img2')->store('img');
            $board->board_img2 = $path;
        }

        $board->save();

        $responseData = [
            'success' => true
            ,'msg' => '게시글 업데이트 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 게시글 삭제
    public function destroy($id) {
        $board = Board::with('questions')
                        ->find($id);
        $board->delete();

        // $question = Question::where('board_id', $id)
        //                     ->find();
        // $question->delete();

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }
}
