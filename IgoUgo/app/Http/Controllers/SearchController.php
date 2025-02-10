<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;



class SearchController extends Controller
{
    public function searchHotel(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $hotels = Product::with('area')
                        ->where('contenttypeid', '32')
                        ->where(function($query) use ($key) {
                            $query->where('title', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                        })
                        ->whereNotNull('firstimage')
                        ->whereNotNull('area_code')
                        ->orderBy('createdtime', 'DESC')
                        ->paginate(5);

        $responseData = [
            'success' => true
            ,'msg' => '검색결과 획득 성공'
            ,'hotel' => $hotels->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function searchProduct(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $products = Product::with('area')
                            ->where(function($query) {
                                $query->where('contenttypeid', '12')
                                    ->orWhere('contenttypeid', '14')
                                    ->orWhere('contenttypeid', '28')
                                    ->orWhere('contenttypeid', '38')
                                    ->orWhere('contenttypeid', '39');
                            })
                            ->where(function($query) use ($key) {
                                $query->where('title', 'LIKE', '%' . $key . '%')
                                    ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                    ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                            })
                            ->whereNotNull('firstimage')
                            ->whereNotNull('area_code')
                            ->orderBy('created_at', 'DESC')
                            ->paginate(5);

        $responseData = [
            'success' => true
            ,'msg' => '검색결과 획득 성공'
            ,'product' => $products->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function searchBoard(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $boards = Board::with('board_category', 'product')
                        ->where('board_flg', '0')
                        ->where(function($query) use ($key) {
                            $query->where('board_title', 'LIKE', '%' . $key . '%')
                                ->orWhere('board_content', 'LIKE', '%' . $key . '%');
                        })
                        ->where(function($query) {
                            $query->where('bc_code', '0')
                            ->orWhere('bc_code', '1');
                        })
                        ->orderBy('created_at', 'DESC')
                        ->paginate(5);

        $responseData = [
            'success' => true
            ,'msg' => '검색결과 획득 성공'
            ,'board' => $boards->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // search in boardlist _____민주
    public function searchBoardContent(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $bc_code = Board::select('boards.bc_code');

        $boards = Board::with(['board_category', 'product'])
                            ->where('boards.bc_code', '=', $request->bc_code)
                            ->where(function($query) use ($key) {
                                $query->where('board_title', 'LIKE', '%' . $key . '%')
                                    ->orWhere('board_content', 'LIKE', '%' . $key . '%');
                            })
                            ->join('users', 'users.user_id', '=', 'boards.user_id')
                            ->when($request->bc_code === '0', function(Builder $query) {
                                $query->join('reviews', function ($join) {
                                        $join->on('reviews.board_id', '=', 'boards.board_id');
                                    })
                                    ->join('products', 'products.product_id', '=', 'reviews.product_id')
                                    ->join('areas', 'products.area_code', '=', 'areas.area_code')
                                    ->join('review_categories', 'review_categories.rc_code', '=', 'products.contenttypeid')
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
                            
                            ->orderBy('created_at', 'DESC')
                        ->paginate(10);
                            
        $responseData = [
            'success' => true
            ,'msg' => '검색결과 획득 성공'
            ,'board' => $boards->toArray()
            // ,'bcName' => $boards->board_category['bc_name']
            ,'rcName' => $bc_code === '0' ? $boards->rc_name : ''
            ,'areaName' => $bc_code === '0' ? $boards->area_name : ''
            ,'productId' => $bc_code === '0' ? $boards->productId : ''
            // ,'likeCount' => $board->likes_count
            ,'board' => $boards->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function searchTester(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $board_testers = Board::with('board_category')
                                ->where('board_flg', '0')
                                ->where(function($query) use ($key) {
                                    $query->where('board_title', 'LIKE', '%' . $key . '%')
                                        ->orWhere('board_content', 'LIKE', '%' . $key . '%');
                                })
                                ->where(function($query) {
                                    $query->where('bc_code', '3');
                                })
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
                                // board_flg 0인 것만 들고와야함
                                
        $responseData = [
            'success' => true
            ,'msg' => '검색결과 획득 성공'
            ,'tester' => $board_testers->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
