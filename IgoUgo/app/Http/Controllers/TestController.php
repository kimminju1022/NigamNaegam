<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $test = Http::get('http://apis.data.go.kr/B551011/KorService1/areaCode1?serviceKey='. env('API_KEY') .'&numOfRows=16&pageNo=1&MobileOS=ETC&MobileApp=AppTest&_type=json');
        
        return response()->json($test->json());
    }
}