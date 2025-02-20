<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Models\BoardCategory;
use App\Models\BoardImage;
use App\Models\BoardReport;
use App\Models\Like;
use App\Models\Review;
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
                    ->join('board_categories', 'boards.bc_code', '=', 'board_categories.bc_code')
                    ->join('products', 'products.product_id', '=', 'reviews.product_id')
                    ->join('areas', 'products.area_code', '=', 'areas.area_code')
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
                    ->select('boards.*', 'users.user_nickname', 'areas.area_name', 'products.contenttypeid', DB::raw('IFNULL(like_tmp.like_cnt, 0) as like_cnt')); // 경진 수정
            })
            ->where('board_title', 'like', "%$request->search%")
            ->where('boards.bc_code', '=', $request->bc_code)
            ->orderBy('boards.created_at', 'desc')
            ->paginate(15);

        // 보드 타이틀 획득
        $boardName = BoardCategory::select('bc_name')
                        ->where('bc_code', '=', $request->bc_code)
                        ->first();
        // 게시물정보 획득
        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            ,'bcName' => $boardName->bc_name
            ,'boardList' => $boardList->toArray()
        ];

        
        // type검증
        // if(!array_key_exists($type, $data)){
        //     return response()->json(['error' => 'type검증'], 400);
        // }
        // return $data[$type];
        return response()->json($responseData, 200);
    }
        
    // ---------------------- meerkat Start ----------------------
    // 게시글 획득_상세
    public function show(Request $request, $id) {
        $board_target = Board::find($id);
 

        // 게시글 ID에 대한 조회 시간 확인
        if (!isset($viewedBoards[$id])) {
            $board_target->view_cnt+=1;
            $board_target->save();
            
        }
        $bc_code = $board_target->bc_code;
        
        // 250124 컬럼에 맞게 수정_민주
        $board = Board::select('boards.*', 'users.user_nickname', 'board_categories.bc_name',)
                    ->join('board_categories', 'board_categories.bc_code', '=', 'boards.bc_code')
                    ->join('users', 'users.user_id', '=', 'boards.user_id')
                    ->when($bc_code === '0', function($query) {
                        $query->join('reviews', 'reviews.board_id', '=', 'boards.board_id')
                            ->join('products', 'products.product_id', '=', 'reviews.product_id')
                            ->join('review_categories','products.contenttypeid', '=', 'review_categories.rc_code')
                            ->join('areas', 'areas.area_code', '=', 'products.area_code')
                            ->addSelect('areas.area_name', 'review_categories.rc_name','reviews.rate', 'products.title');     //3rd
                            /**2nd code
                             * ->join('review_categories', 'review_categories.bc_code', '=', 'reviews.bc_code')
                             * ->select('boards.*', 'users.user_nickname', 'board_categories.bc_name', 'areas.area_name', 'review_categories.rc_name', 'reviews.rate', 'reviews.bc_code', 'reviews.area_code');
                             */
                    })
                    ->withCount('likes')
                    ->with('board_images') // add 3rd
                    ->with('comments') // add 3rd
                    ->where('boards.board_id', '=', $id)
                    ->first();

        // 좋아요 여부 
        $likeFlg = false;
        if($request->bearerToken()) {
            $idt =  MyToken::getValueInPayload($request->bearerToken(), 'idt');
            $likeFlg = Like::where('board_id', $board->board_id)->where('user_id', $idt)->where('like_flg', '1')->exists();
        }

        $responseData = [
            'success' => true
            ,'msg' =>'게시글획득성공'
            ,'bcName' => $board->bc_name
            ,'rcName' => $bc_code === '0' ? $board->rc_name : ''
            ,'areaName' => $bc_code === '0' ? $board->area_name : ''
            ,'productId' => $bc_code === '0' ? $board->productId : ''
            // ,'likeCount' => $board->likes_count
            ,'board' => $board->toArray()
            ,'likeFlg' => $likeFlg
        ];

        return response()->json($responseData, 200);
    }

    // 좋아요
    public function like(Request $request, $id) {
        $idt =  MyToken::getValueInPayload($request->bearerToken(), 'idt');
        
        $like = Like::where('board_id', $id)->where('user_id', $idt)->first();
        if($like) {
            $like->like_flg = $like->like_flg === '0' ? '1' : '0';
        } else {
            $like = new Like();
            $like->board_id = $id;
            $like->user_id = $idt;
            $like->like_flg = '0';
        }

        $like->save();

        $responseData = [
            'success' => true
            ,'msg' =>'좋아요 변경 성공'
            ,'likeFlg' => $like->like_flg === '0' ? false : true
        ];

        return response()->json($responseData, 200);
    }

    // ---------------------- meerkat End ----------------------

    // 게시글 작성
    public function store(BoardRequest $request) {
        Log::debug('files', $request->board_img);

        try {
            DB::beginTransaction();
            $insertData = $request->only('board_title','board_content');
            $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
            $insertData['view_cnt'] = 0;
            $insertData['bc_code'] = $request->bc_code;

            $board = Board::create($insertData);
            
            // 3차 보드 이미지 저장작업
            if($request->has('board_img')) {
                foreach ($request->board_img as $file) {
                    $path = '/'.$file->store('img');
                    BoardImage::create([
                        'board_id' => $board->board_id,
                        'board_img' => $path,
                    ]);
                }
            }
            
            if($request->bc_code === '0') {
                $insertReview['board_id'] = $board->board_id;
                // $insertReview['area_code'] = $request->area_code;
                // $insertReview['bc_code'] = $request->bc_code;
                $insertReview['rate'] = $request->rate;
                $insertReview['product_id'] = $request->rate;
                
                $review = Review::create($insertReview);
            } else if($request->bc_code === '1'){

            }
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $responseData = [
            'success' => true,
            'msg' => '게시글 작성 성공',
            'board' => $board->toArray(),
        ];
        // if ($request->hasFile('board_img')){
            // $insertData['board_img'] = '/'.$request->file('board_img')->store('img');
            // } else {
            //     $insertData['board_img'] = '/default/board_default.png';
            // }
        // 
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
            // $boardTarget->bc_code = $request->bc_code; //2nd 250124
            $boardTarget->board_title = $request->board_title;
            $boardTarget->board_content = $request->board_content;
            // img일치 확인 및 불일치 시 새정보 적용
            if ($request->hasFile('board_img') && $request->file('board_img')->isValid()) {
                $path = '/'.$request->file('board_img')->store('img');
                $boardTarget->board_img = $path;
            } else {
                // unset($boardTarget->board_img); 
                $boardTarget->board_img = null; // unset 대신 null 사용
            }
            if($boardTarget->bc_code === '0') {
                $review = Review::where('board_id', $request->id)->first();

                $review->area_code = $request->area_code;
                $review->bc_code = $request->bc_code;
                $review->rate = $request->rate;
                $review->save();
            } else if($boardTarget-> bc_code === '1') {
                // Review::where('board_id', $request->id)->delete(); //2nd 250124               
            }
            // 2nd 작업(보드img별 버튼으로 구현(총2개개))
            // if($request->hasFile('board_img2') && $request->file('board_img2')->isValid()) {
            //     $path = '/'.$request->file('board_img2')->store('img');
            //     $boardTarget->board_img2 = $path;
            // }

            /*
            // 4가지 상황에 따른 쿼리-------------------------------------------start------2nd작업(보드타입변경작업)
            // 리뷰에서 자유로 변경 시 저장 방법 변경(리뷰테이블 내 정보 삭제)
            if($boardTarget->getOriginal('bc_code') === '0') {
                $review = Review::where('board_id', $request->id)->first();

                if($boardTarget->bc_code === '0') {
                    $review->area_code = $request->area_code;
                    $review->bc_code = $request->bc_code;
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
                    $review->bc_code = $request->bc_code;
                    $review->rate = $request->rate;
                    $review->save();
                }
            }
            // 4가지 상황에 따른 쿼리-------------------------------------------end------
            */
            // boards update
            $boardTarget->save();

            $board = Board::select('boards.*', 'users.user_nickname', 'board_categories.bc_name')
                        ->join('board_categories', 'board_categories.bc_code', '=', 'boards.bc_code')
                        ->join('users', 'users.user_id', '=', 'boards.user_id')
                        ->when($boardTarget->bc_code === '0', function($query) {
                            $query->join('reviews', 'reviews.board_id', '=', 'boards.board_id')
                                    ->join('products', 'products.product_id', '=', 'reviews.product_id')
                                    ->join('areas', 'areas.area_code', '=', 'products.area_code')
                                    // 2nd 작업250124 수정
                                    // ->join('areas', 'areas.area_code', '=', 'reviews.area_code')
                                    // ->join('review_categories', 'review_categories.bc_code', '=', 'reviews.bc_code')
                                    ->select('boards.*', 'users.user_nickname', 'board_categories.bc_name', 'areas.area_name', 'products.contenttypeid', 'reviews.rate');
                        })
                        // ->withCount('likes')
                        ->where('boards.board_id', '=', $boardTarget->board_id)
                        ->first();
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            Log::error('게시글 수정 중 오류 발생: ' . $th->getMessage());
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

    // ------------------- meerkat Start -------------------
    // 게시글 삭제
    public function destroy($id) {
        $board = Board::destroy($id);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }

    // 게시글 신고
    public function report(Request $request, $id){
        // responseData 초기화
        $responseData = [
            'success' => true
            ,'msg' => ''
        ];

        $idt = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        // 신고 정보 저장
        try {
            DB::beginTransaction();

            // 중복 신고 방지 체크
            $existingReport = BoardReport::where('board_id', $id)
                ->where('user_id', $idt)
                ->exists();
            
            if(!$existingReport) {
                $report = new BoardReport();
                $report->board_id = $id;
                $report->user_id = $idt;
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
    // ------------------- meerkat Start -------------------

    // 게시글 좋아요
    // public function likeFlg($userId,$likes){
    //     $like = Board::where('user_id', $userId)
    //                 ->where('board_id', $Id)
    //                 ->fist();
    //     // like취소
    //     if($like){
    //         $like->like_flg = $like->like_flg ? 0:1;
    //         $like->save();
    //     } else {
    //         self::create([

    //         ])
    //     }
    
    // }

// 게시글-------------------------------------update end---------------------


    // 경진 -------------------------------------------------------------------------------------
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

    // 내가 쓴 리뷰게시글
    public function showMyReview($id){
        $boardList = Board::with(['user', 'review', 'likes', 'product'])
                                ->withCount('likes')
                                ->where('user_id', $id)
                                ->where('bc_code', '0')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        // Log::debug($boardList);

        $responseData = [
            'success' => true
            ,'msg' =>' 유저의 리뷰게시글 획득 성공'
            ,'board' => $boardList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 내가 쓴 자유게시글
    public function showMyFree($id){
        $boardList = Board::with(['user', 'likes', 'product'])
                                ->withCount('likes')
                                ->where('user_id', $id)
                                ->where('bc_code', '1')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        // Log::debug($boardList);

        $responseData = [
            'success' => true
            ,'msg' =>' 유저의 자유게시글 획득 성공'
            ,'board' => $boardList->toArray()
        ];

        return response()->json($responseData, 200);
    }
    // 경진 -------------------------------------------------------------------------------------
}

