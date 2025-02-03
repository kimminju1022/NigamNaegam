<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request) {
        // Log::debug($request);
        $key = $request->input('search');

        $hotels = Product::where(function($query) use ($key) {
                            $query->where('title', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                        })->orderBy('created_at', 'DESC')
                        ->paginate(5);

        $products = Product::where(function($query) use ($key) {
                            $query->where('title', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr1', 'LIKE', '%' . $key . '%')
                                ->orWhere('addr2', 'LIKE', '%' . $key . '%');
                        })->orderBy('created_at', 'DESC')
                        ->paginate(5);

        $boards = Board::where(function($query) use ($key) {
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
            ,'hotel' => $hotels->toArray()
            ,'product' => $products->toArray()
            ,'board' => $boards->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
