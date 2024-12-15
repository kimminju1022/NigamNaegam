<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function hotelProducts()
    {
        $hotels = Http::get('http://apis.data.go.kr/B551011/KorService1/searchStay1?serviceKey='. env('API_KEY') .'&numOfRows=16&pageNo=1&MobileOS=ETC&MobileApp=IgoUgo&_type=json');

        return response()->json($hotels->json());
    }
}
