<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $test = Http::get('http://apis.data.go.kr/B551011/KorService1/areaCode1?serviceKey='. env('API_KEY') .'&numOfRows=10&pageNo=1&MobileOS=ETC&MobileApp=AppTest&_type=json');
        
        if ($test->failed()) {
            echo "오류남";
        }

        $array = json_decode($test->body(), TRUE);

        return response()->json($array);
    }
}
