<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function searchHotel(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $hotels = Product::with('area')
                        ->where(function($query) use ($key) {
                            $query->where('title', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                        })
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

        $products = Product::where(function($query) use ($key) {
                            $query->where('title', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                        })
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

        $boards = Board::with('board_category')
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

    public function searchTester(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $board_testers = Board::with('board_category')
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

    // 게시판 작성용 검색
    public function searchBoardProduct(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $commodity = Product::where(function($query) use ($key) {
                            $query->where('title', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                        })->orderBy('created_at', 'DESC')
                        ->paginate(5);

        $responseData = [
            'success' => true
            ,'msg' => '검색결과 획득 성공'
            ,'commodity' => $commodity->toArray()
        ];

        return response()->json($responseData, 200);
    }
    // 게시판 리스트용 검색
}
