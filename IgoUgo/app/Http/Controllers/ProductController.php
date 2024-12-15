<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function productData(Request $request) {
        $url = 'http://apis.data.go.kr/B551011/KorService1/searchFestival1';
        $serviceKey = env('API_KEY');

        // HTTP 요청
        $response = Http::get($url, [
            'numOfRows' => 16,
            'pageNo' => 1,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
            'listYN' => 'Y',
            'eventStartDate' => '20241201',
        ]);

        if($response->successful()) {
            return response()->json($response->json());
        }
    }
}
