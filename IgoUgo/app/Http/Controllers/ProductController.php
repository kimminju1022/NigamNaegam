<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function productData() {
        // $url = 'http://apis.data.go.kr/B551011/KorService1/searchFestival1';
        $url = 'http://apis.data.go.kr/B551011/KorService1/areaBasedList1';
        $serviceKey = env('API_KEY');
        // Log::debug($serviceKey);

        // HTTP 요청
        $festivals = Http::get($url, [
            'serviceKey' => $serviceKey,
            'numOfRows' => 10,
            'pageNo' => 1,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
            // 'eventStartDate' => '20000101',
        ]);

        $resultCode = $festivals->header('resultCode');

        if($festivals->failed() && $resultCode !== '0000') {
            throw new \Exception('API 받아오기 실패'. $festivals->status());
        }
        
        return response()->json($festivals->json());
    }
}
