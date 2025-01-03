<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMainController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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
Route::get('/testdata', [TestController::class, 'index']);

// 호텔리스트 라우터
Route::get('/hotels', [HotelController::class, 'hotels']);
Route::get('/areas', [HotelController::class, 'areas']);
Route::get('/categories', [HotelController::class, 'categories']);
Route::get('/hotels/{contentid}', [HotelController::class, 'hotelsDetail']);

// ----- 상품 관련 -----
// 상품 메인 라우터
Route::get('/products', [ProductMainController::class, 'getFilteredProducts']);
// 각 카테고리별 상품리스트 라우터
Route::get('/products/{contenttypeid}', [ProductMainController::class, 'showList']);
Route::get('/products/{contenttypeid}/{contentid}', [ProductMainController::class, 'productDetail']);
Route::get('/product/random', [ProductMainController::class, 'getProductRandom']);

// 로그인 관련
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');

// 리뷰/자유 게시판용 라우터
Route::get('/boards', [BoardController::class, 'index'])->name('board.index');
Route::get('/boards/review', [BoardController::class, 'showReview']);
Route::get('/boards/free', [BoardController::class, 'showFree']);
Route::get('/boards/{id}', [BoardController::class, 'show'])->name('board.show');

// 코켄트 관련
Route::get('/comments', [CommentController::class, 'index'])->name('comment.index');

// 문의 게시판용 라우터
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{id}',[QuestionController::class, 'show']);

// 인증필요 라우트 그룹
Route::middleware('my.auth')->group(function() {
    // 로그아웃
    Route::post('/logout', [AuthController::class, 'logout']);
    // 토큰 재발급
    Route::post('/reissue', [AuthController::class, 'reissue']);
    
    // 유저 관련
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::post('/password/{id}', [UserController::class, 'chkPW']);
    Route::put('/password/{id}', [UserController::class, 'updatePW'])->name('password.update');

    // 게시판 관련
    Route::post('/boards',[BoardController::class, 'store']);
    Route::get('/boards/{id}/edit',[BoardController::class, 'edit'])->name('board.edit');
    Route::put('/boards/{id}/update',[BoardController::class, 'update'])->name('board.update');
    // 댓글관련 생성예정

    // 문의게시판 관련
    Route::get('/user/questions/{id}', [QuestionController::class, 'showMyQuestion']);
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit']);
    Route::post('/questions/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
});

