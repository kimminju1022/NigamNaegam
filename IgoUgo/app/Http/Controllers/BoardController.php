<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Models\BoardCategory;
use App\Models\Comment;
use App\Models\Review;
use Database\Seeders\AreaSeeder;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MyToken;
use Throwable;

class BoardController extends Controller
{
    //리스트정보_ action-Method
    public function index(Request $request) {
        $boardList = Board::select('boards.*','users.user_nickname')->
            join('users', 'users.user_id', '=', 'boards.user_id')
            ->when($request->bc_code === '0', function(Builder $query) {
                $query->join('reviews', function ($join) {
                        $join->on('reviews.board_id', '=', 'boards.board_id');
                    })
                    ->join('areas', 'areas.area_code', '=', 'reviews.area_code')
                    ->leftJoinSub(
                        DB::table('likes')
                            ->select('likes.board_id', DB::raw('COUNT(likes.like_id) as like_cnt'))
                            ->where('like_flg', '=', '1')
                            ->groupBy('likes.board_id'),
                        'like_tmp',
                        'boards.board_id',
                        '=',
                        'like_tmp.board_id'
                    )
                    ->select('boards.*', 'users.user_nickname', 'areas.area_name', DB::raw('IFNULL(like_tmp.like_cnt, 0) as like_cnt'));
            })
            ->where('boards.bc_code', '=', $request->bc_code)
            ->orderBy('boards.created_at', 'desc')
            ->paginate(15);

        // 보드 타이틀 획득
        $boardTitle = BoardCategory::select('bc_name')
                        ->where('bc_code', '=', $request->bc_code)
                        ->first();
        // 게시물정보 획득
        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            ,'bcName' => $boardTitle->bc_name
            ,'boardList' => $boardList->toArray()
        ];

        
        // type검증
        // if(!array_key_exists($type, $data)){
        //     return response()->json(['error' => 'type검증'], 400);
        // }
        // return $data[$type];
        return response()->json($responseData, 200);
    }
        
    // 게시글 획득_상세
    public function show($id){
        $board_target = Board::find($id);
        
        $board_target->view_cnt+=1;
        // $board_target->view_cnt++;
        $board_target->save();

        $bc_code = $board_target->bc_code;
        // $board = Board::with(['user', 'board_category'])->when($bc_code === '0', function($query) {
        //                 $query->with(['area', 'review', 'review_category']);
        //             })
        //             ->find($id);

        $board = Board::select('boards.*', 'users.user_nickname', 'board_categories.bc_name')
                    ->join('board_categories', 'board_categories.bc_code', '=', 'boards.bc_code')
                    ->join('users', 'users.user_id', '=', 'boards.user_id')
                    ->when($bc_code === '0', function($query) {
                        $query->join('reviews', 'reviews.board_id', '=', 'boards.board_id')
                            ->join('areas', 'areas.area_code', '=', 'reviews.area_code')
                            ->join('review_categories', 'review_categories.rc_code', '=', 'reviews.rc_code')
                            ->select('boards.*', 'users.user_nickname', 'board_categories.bc_name', 'areas.area_name', 'review_categories.rc_name', 'reviews.rate', 'reviews.rc_code', 'reviews.area_code');
                    })
                    ->withCount('likes')
                    ->with('board_images') // add 3rd
                    ->with('comment_content') // add 3rd
                    ->where('boards.board_id', '=', $id)
                    ->first();

        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            ,'bcName' => $board->bc_name
            ,'rcName' => $bc_code === '0' ? $board->rc_name : ''
            ,'areaName' => $bc_code === '0' ? $board->area_name : ''
            ,'board' => $board->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 게시글 작성
    public function store(BoardRequest $request) {
        $insertData = $request->only('board_title','board_content');
        $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        $insertData['view_cnt'] = 0;
        $insertData['bc_code'] = $request->bc_code;

        // 3차 보드 이미지 저장작업
        if ($request->hasFile('board_img')){
            $insertData['board_img'] = '/'.$request->file('board_img')->store('img');
            } else {
                $insertData['board_img'] = '/default/board_default.png';
            }
        
        // 2차 보드 이미지 작업---------------------*start*
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
        // 2차 보드 이미지 작업---------------------*end*


        $board = Board::create($insertData);

        if($request->bc_code === '0') {
            $insertReview['board_id'] = $board->board_id;
            $insertReview['area_code'] = $request->area_code;
            $insertReview['rc_code'] = $request->rc_code;
            $insertReview['rate'] = $request->rate;
            
            $review = Review::create($insertReview);
        }

        $responseData = [
            'success' => true
            ,'msg' => '게시글 작성 성공'
            ,'board' => $board->toArray()
            ,'review' => isset($review) ? $review->toArray() : null
        ];

        return response()->json($responseData, 200);
    }

    // 게시글 수정
    public function update(BoardRequest $request) {
        try {
            DB::beginTransaction();
            $boardTarget = Board::find($request->id);

            if($boardTarget-> bc_code !== $request->bc_code){
                $boardTarget->bc_code = $request->bc_code;
            }
            // $boardTarget->bc_code = $request->bc_code;
            $boardTarget->board_title = $request->board_title;
            $boardTarget->board_content = $request->board_content;
            // img일치 확인 및 불일치 시 새정보 적용
            if ($request->hasFile('board_img') && $request->file('board_img')->isValid()) {
                $path = '/'.$request->file('board_img')->store('img');
                $boardTarget->board_img = $path;
            } else {
                unset($boardTarget->board_img); 
            }
            
            // if($request->hasFile('board_img') && $request->file('board_img')->isValid()) {
            //     $path = '/'.$request->file('board_img')->store('img');
            //     $boardTarget->board_img = $path;
            // }
            // if($request->hasFile('board_img2') && $request->file('board_img2')->isValid()) {
            //     $path = '/'.$request->file('board_img2')->store('img');
            //     $boardTarget->board_img2 = $path;
            // }

            // 4가지 상황에 따른 쿼리-------------------------------------------start------
            // 리뷰에서 자유로 변경 시 저장 방법 변경(리뷰테이블 내 정보 삭제)
            if($boardTarget->getOriginal('bc_code') === '0') {
                $review = Review::where('board_id', $request->id)->first();

                if($boardTarget->bc_code === '0') {
                    $review->area_code = $request->area_code;
                    $review->rc_code = $request->rc_code;
                    $review->rate = $request->rate;
                    $review->save();
                } else if($boardTarget->bc_code === '1') {
                    $review->delete();
                }
            } else if($boardTarget->getOriginal('bc_code') === '1') {
                if($boardTarget->bc_code === '0') {
                    $review = new Review();
                    $review->board_id = $request->id;
                    $review->area_code = $request->area_code;
                    $review->rc_code = $request->rc_code;
                    $review->rate = $request->rate;
                    $review->save();
                }
            }

            // boards update
            $boardTarget->save();

            $board = Board::select('boards.*', 'users.user_nickname', 'board_categories.bc_name')
                        ->join('board_categories', 'board_categories.bc_code', '=', 'boards.bc_code')
                        ->join('users', 'users.user_id', '=', 'boards.user_id')
                        ->when($boardTarget->bc_code === '0', function($query) {
                            $query->join('reviews', 'reviews.board_id', '=', 'boards.board_id')
                            ->join('areas', 'areas.area_code', '=', 'reviews.area_code')
                            ->join('review_categories', 'review_categories.rc_code', '=', 'reviews.rc_code')
                            ->select('boards.*', 'users.user_nickname', 'board_categories.bc_name', 'areas.area_name', 'review_categories.rc_name', 'reviews.rate', 'reviews.rc_code', 'reviews.area_code');
                        })
                        ->withCount('likes')
                        ->where('boards.board_id', '=', $boardTarget->board_id)
                        ->first();
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 수정 성공'
            ,'bcName' => $board->bc_name
            ,'rcName' => $board->bc_code === '0' ? $board->rc_name : ''
            ,'areaName' => $board->bc_code === '0' ? $board->area_name : ''
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 게시글 수정 시 리뷰테이블 삭제 --------------------------!!!!!!!!!!!!

    // 게시글 삭제
    public function destroy($id) {
        $board = Board::destroy($id);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }

// 게시글-------------------------------------update end---------------------

    // 게시판 리뷰 top4
    public function showReview(){
        $boardReview = Board::select('board_title', 'board_content', 'board_id', 'user_id')
                                ->withCount('likes')
                                // ->with(['user', 'likes'])
                                ->with([
                                    'user' => function ($query) {
                                        $query->withTrashed();
                                    },
                                    'likes'
                                ])
                                ->where('bc_code', 0)
                                ->groupBy('board_id', 'board_title', 'board_content', 'user_id')
                                ->orderBy('likes_count','DESC')
                                ->limit(4)
                                ->get();

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 리스트 획득 성공'
            ,'boardReview' => $boardReview->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 게시판 자유 top4
    public function showFree(){
        $boardFree = Board::select('board_title', 'board_content', 'board_id', 'user_id')
                                ->withCount('likes')
                                ->with(['user', 'likes'])
                                ->with([
                                    'user' => function ($query) {
                                        $query->withTrashed();
                                    },
                                    'likes'
                                ])
                                ->where('bc_code', 1)
                                ->groupBy('board_id', 'board_title', 'board_content', 'user_id')
                                ->orderBy('likes_count','DESC')
                                ->limit(4)
                                ->get();

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 리스트 획득 성공'
            ,'boardFree' => $boardFree->toArray()
        ];
        return response()->json($responseData, 200);
    }
}

