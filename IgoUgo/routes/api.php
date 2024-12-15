<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 테스트용 라우터
Route::get('/test-data', [TestController::class, 'index']);

// 호텔리스트 라우터
Route::get('/hotels', [ApiController::class, 'hotelProducts']);

