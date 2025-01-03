<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Models\BoardCategory;
use App\Models\Comment;
use App\Models\Review;
use Database\Seeders\AreaSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MyToken;

class BoardController extends Controller
{
    // action-Method

    public function index(Request $request) {
        $boardList = Board::select('boards.*')->
            join('users', 'users.user_id', '=', 'boards.user_id')
            ->when($request->bc_type === '0', function(Builder $query) {
                return $query->join('reviews', function ($join) {
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
                    );
            })
            ->where('boards.bc_type', '=', $request->bc_type)
            ->orderBy('boards.created_at', 'desc')
            ->paginate(15);

        // 보드 타이틀 획득
        $boardTitle = BoardCategory::select('bc_name')
                        ->where('bc_type', '=', $request->bc_type)
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
        
    // 디테일페이지
    public function show($id){
        $bc_type = Board::select('bc_type')->find($id)->bc_type;

        // $board = Board::with(['user', 'board_category'])->when($bc_type === '0', function($query) {
        //                 $query->with(['area', 'review', 'review_category']);
        //             })
        //             ->find($id);

        $board = Board::select('boards.*', 'users.user_nickname', 'board_categories.bc_name')
                    ->join('board_categories', 'board_categories.bc_type', '=', 'boards.bc_type')
                    ->join('users', 'users.user_id', '=', 'boards.user_id')
                    ->when($bc_type === '0', function($query) {
                        $query->join('reviews', 'reviews.board_id', '=', 'boards.board_id')
                        ->join('areas', 'areas.area_code', '=', 'reviews.area_code')
                        ->join('review_categories', 'review_categories.rc_type', '=', 'reviews.rc_type')
                        ->select('boards.*', 'users.user_nickname', 'board_categories.bc_name', 'areas.area_name', 'review_categories.rc_name', 'reviews.rate');
                    })
                    ->withCount('likes')
                    ->where('boards.board_id', '=', $id)
                    ->first();

        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            ,'bcName' => $board->bc_name
            ,'rcName' => $bc_type === '0' ? $board->rc_name : ''
            ,'areaName' => $bc_type === '0' ? $board->area_name : ''
            ,'board' => $board->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 게시판 리뷰 top4
    public function showReview(){
        $boardReview = Board::select('board_title', 'board_img1', 'board_id', 'user_id')
                                ->withCount('likes')
                                ->with(['user', 'likes'])
                                ->where('bc_type', 0)
                                ->groupBy('board_id', 'board_title', 'board_img1', 'user_id')
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
        $boardFree = Board::select('board_title', 'board_img1', 'board_id', 'user_id')
                                ->withCount('likes')
                                ->with(['user', 'likes'])
                                ->where('bc_type', 1)
                                ->groupBy('board_id', 'board_title', 'board_img1', 'user_id')
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

    // 게시글 작성
    public function store(BoardRequest $request) {
        $insertData = $request->only('board_title','board_content');
        $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        $insertData['view_cnt'] = 0;
        $insertData['bc_type'] = $request->bc_type;

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

        if($request->bc_type === '0') {
            $insertReview['board_id'] = $board->board_id;
            $insertReview['area_code'] = $request->area_code;
            $insertReview['rc_type'] = $request->rc_type;
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
}