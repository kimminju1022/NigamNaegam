<?php

use App\Http\Controllers\admin\UserManageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SearchController;
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

// 유저 사이트 ---------------------------------------------------------------------------------------

// 호텔리스트 라우터
Route::get('/hotels', [HotelController::class, 'hotels']);
Route::get('/areas', [HotelController::class, 'areas']);
Route::get('/categories', [HotelController::class, 'categories']);
Route::get('/hotels/{contentid}', [HotelController::class, 'hotelsDetail']);
Route::get('/hotels/get/categories', [HotelController::class, 'getHotelCategories']);
Route::post('/hotels', [HotelController::class, 'getNearbyPlaces']);
Route::get('/hotels/align/rank', [HotelController::class, 'ranking']);
Route::get('/hotels/fillter/nearby', [HotelController::class, 'getHotelNearBy']);


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

// 소셜로그인
Route::get('/auth/login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
Route::post('/auth/social', [AuthController::class, 'socialLogin']);

// 이메일 인증
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationLink'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

// 비밀번호 찾기
Route::post('/find/pw/send-email', [AuthController::class, 'sendEmail'])->name('auth.send');
Route::get('/find/pw/{id}/{hash}', [AuthController::class, 'verify'])->name('auth.verify');
Route::put('/verify/pw/{id}', [UserController::class, 'verifiedUpdatePW'])->name('verify.password.update');

// 리뷰/자유 게시판용 라우터
Route::get('/boards', [BoardController::class, 'index'])->name('board.index');
Route::get('/boards/review', [BoardController::class, 'showReview']);
Route::get('/boards/free', [BoardController::class, 'showFree']);
Route::get('/boards/{id}', [BoardController::class, 'show'])->name('board.show');
// Route::get('/boards/search/{keyword}', [BoardController::class, 'search'])->name('board.search');

// 검색관련
Route::get('search', [BoardController::class, 'index'])->name('search.index'); //보드로 해도 되나?

// 코멘트 관련
Route::get('/comments', [CommentController::class, 'index'])->name('comment.index');

// 문의 게시판용 라우터
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{id}',[QuestionController::class, 'show']);

// 검색 라우터
Route::get('/search/hotel', [SearchController::class, 'searchHotel']);
Route::get('/search/product', [SearchController::class, 'searchProduct']);
Route::get('/search/board', [SearchController::class, 'searchBoard']);
Route::get('/search/board/tester', [SearchController::class, 'searchTester']);
Route::get('/search/board/content', [SearchController::class, 'searchBoardContent']);


// 관리자 사이트 ---------------------------------------------------------------------------------------

// 관리자 로그인
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('auth.admin.login');

// 차트
Route::get('/admin/daily/user/signup', [ChartController::class, 'showDailySignUp']);
Route::get('/admin/monthly/user/signup', [ChartController::class, 'showMonthlySignUp']);
Route::get('/admin/daily/user/delete', [ChartController::class, 'showDailyDeletedAccount']);
Route::get('/admin/daily/review', [ChartController::class, 'showDailyReview']);
Route::get('/admin/daily/free', [ChartController::class, 'showDailyFree']);
Route::get('/admin/daily/question/yet', [ChartController::class, 'showDailyQuestionYet']);
Route::get('/admin/daily/question/done', [ChartController::class, 'showDailyQuestionDone']);

// 유저 관리
Route::get('/admin/user', [UserManageController::class, 'getUserList']);
Route::get('/admin/user/{id}', [UserManageController::class, 'getUserDetail']);
Route::get('/admin/user/{id}/boardcnt', [UserManageController::class, 'getBoardCnt']);

// 문의게시판
Route::get('/admin/question/yet', [QuestionController::class, 'adminQuestionYet']);
Route::get('/admin/question/done', [QuestionController::class, 'adminQuestionDone']);


// 인증 관련 ---------------------------------------------------------------------------------------
// 인증필요 라우트 그룹
Route::middleware('my.auth')->group(function() {
    // 로그아웃
    Route::post('/logout', [AuthController::class, 'logout']);
    // 관리자 로그아웃
    Route::post('/admin/logout', [AuthController::class, 'adminLogout']);


    // 토큰 재발급
    Route::post('/reissue', [AuthController::class, 'reissue']);
    
    // 유저 관련
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::post('/password/{id}', [UserController::class, 'chkPW']);
    Route::put('/password/{id}', [UserController::class, 'updatePW'])->name('password.update');

    // 유저별 게시판 내역
    Route::get('/user/questions/{id}', [QuestionController::class, 'showMyQuestion']);
    Route::get('/user/review/{id}', [BoardController::class, 'showMyReview']);
    Route::get('/user/free/{id}', [BoardController::class, 'showMyFree']);


    // 게시판 관련
    Route::post('/boards',[BoardController::class, 'store']);
    Route::get('/boards/{id}/edit',[BoardController::class, 'edit'])->name('board.edit');
    Route::post('/boards/{id}',[BoardController::class, 'update'])->name('board.update');
    Route::post('/boards/{id}/report',[BoardController::class, 'report'])->name('board.report'); 
    Route::delete('/boards/{id}',[BoardController::class, 'destroy'])->name('board.destroy');
    
    // 댓글  관련
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/comments/{id}/report',[CommentController::class, 'report'])->name('comment.report');
    Route::delete('/comments/{id}',[CommentController::class, 'destroy'])->name('comment.destroy');
    
    // 문의게시판 관련
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit']);
    Route::post('/questions/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
});
