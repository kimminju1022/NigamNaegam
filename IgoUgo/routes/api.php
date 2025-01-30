<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

// 호텔리스트 라우터
Route::get('/hotels', [HotelController::class, 'hotels']);
Route::get('/areas', [HotelController::class, 'areas']);
Route::get('/categories', [HotelController::class, 'categories']);
Route::get('/hotels/{contentid}', [HotelController::class, 'hotelsDetail']);
Route::post('/hotels', [HotelController::class, 'getNearbyPlaces']);
Route::get('/hotels/align/rank', [HotelController::class, 'ranking']);


// ----- 상품 관련 -----
// 상품 메인 라우터
Route::get('/products', [ProductController::class, 'getFilteredProducts']);
// 각 카테고리별 상품리스트 라우터
Route::get('/products/{contenttypeid}', [ProductController::class, 'showList']);
Route::get('/products/{contenttypeid}/{contentid}', [ProductController::class, 'productDetail']);
Route::get('/product/random', [ProductController::class, 'getProductRandom']);
Route::post('/products', [ProductController::class, 'getNearbyPlaces']);

// 로그인 관련
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
Route::post('/available/email', [UserController::class, 'chkEmail'])->name('user.email');
Route::post('/available/nickname', [UserController::class, 'chkNickname'])->name('user.nickname');
Route::post('/available/phone', [UserController::class, 'chkPhone'])->name('user.phone');

// 카카오 소셜로그인
// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();

//     // $user->token
// });

Route::get('/auth/login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
Route::post('/auth/social', [AuthController::class, 'socialLogin']);

// 이메일 인증
// Route::get('/email/verify/{id}', [VerificationController::class, 'notice'])->middleware('my.auth')->name('verification.notice');
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationLink'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::get('/profile', function () {
//     // Only verified users may access this route...
// })->middleware(['auth', 'verified']); // 1. 이메일 검증된 사용자만 접근 가능

// 비밀번호 찾기
Route::post('/find/pw/send-email', [AuthController::class, 'sendEmail'])->name('auth.send');
Route::get('/find/pw/{id}/{hash}', [AuthController::class, 'verify'])->name('auth.verify');
Route::put('/verify/pw/{id}', [UserController::class, 'verifiedUpdatePW'])->name('verify.password.update');

// 리뷰/자유 게시판용 라우터
Route::get('/boards', [BoardController::class, 'index'])->name('board.index');
Route::get('/boards/review', [BoardController::class, 'showReview']);
Route::get('/boards/free', [BoardController::class, 'showFree']);
Route::get('/boards/{id}', [BoardController::class, 'show'])->name('board.show');

// 코멘트 관련
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
    Route::post('/boards/{id}',[BoardController::class, 'update'])->name('board.update');
    Route::post('/boards/{id}',[BoardController::class, 'report'])->name('board.report'); //가능한지 물어보기
    Route::delete('/boards/{id}',[BoardController::class, 'destroy'])->name('board.destroy');
    
    // 댓글  관련
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/comments/{id}',[CommentController::class, 'report'])->name('comment.report'); //가능한지 물어보기
    Route::delete('/comments/{id}',[CommentController::class, 'destroy'])->name('comment.destroy');

    // 문의게시판 관련
    Route::get('/user/questions/{id}', [QuestionController::class, 'showMyQuestion']);
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit']);
    Route::post('/questions/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
});


Route::get('/test-email', [TestController::class, 'sendTestEmail']);
