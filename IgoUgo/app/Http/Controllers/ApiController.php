<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function hotelProducts()
    {
        $url = 'http://apis.data.go.kr/B551011/KorService1/searchStay1';
        $serviceKey = env('API_KEY');
        // LOG::debug($serviceKey);

        $hotels = HTTP::get($url, [
            'serviceKey' => $serviceKey,
            'numOfRows' => 20,
            'pageNo' => 1,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
        ]);

        $resultCode = $hotels->header('resultCode');

        Log::debug($serviceKey);

        if($hotels->failed() && $resultCode !== '0000') {
            throw new \Exception('API 받아오기 실패'. $hotels->status());
        }

        return response()->json($hotels->json());
    }
}
