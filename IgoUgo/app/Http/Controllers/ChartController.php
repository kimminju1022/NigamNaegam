<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    // 오늘 가입회원 수
    public function showTodaySignUp() {
        $date = Carbon::today()->toDateString();

        $today_user = User::whereDate('created_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 가입회원 수 획득 성공'
            ,'data' => $today_user
        ];
        return response()->json($responseData, 200);
    }

    // 한 달 가입회원 수
    public function showMonthlySignUp() {
        Log::debug('함수실행');
        $date_start = Carbon::today()->startOfMonth()->toDateString();
        $date_end = Carbon::today()->endOfMonth()->toDateString();

        Log::debug($date_start);

        $monthly_user = User::whereBetween('created_at', [$date_start, $date_end])
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'한 달 가입회원 수 획득 성공'
            ,'data' => $monthly_user
        ];
        return response()->json($responseData, 200);
    }

    // 오늘 가입회원 수
    public function showTodaySignUp() {
        $date = Carbon::today()->toDateString();

        $today_user = User::whereDate('created_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 가입회원 수 획득 성공'
            ,'data' => $today_user
        ];
        return response()->json($responseData, 200);
    }

    // 오늘 탈퇴회원 수
    public function showTodayDeletedAccount() {
        $date = Carbon::today()->toDateString();

        $today_user = User::withTrashed()
                            ->whereDate('deleted_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 탈퇴회원 수 획득 성공'
            ,'data' => $today_user
        ];
        return response()->json($responseData, 200);
    }x

    // 오늘 리뷰게시판 게시글 수
    public function showTodayReview() {
        $date = Carbon::today()->toDateString();

        $today_review = Board::where('bc_code', '0')
                            ->where('board_flg', '0')
                            ->whereDate('created_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 리뷰게시글 수 획득 성공'
            ,'data' => $today_review
        ];
        return response()->json($responseData, 200);
    }

    // 오늘 자유게시판 게시글 수    
    public function showTodayFree() {
        $date = Carbon::today()->toDateString();

        $today_free = Board::where('bc_code', '1')
                            ->where('board_flg', '0')
                            ->whereDate('created_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 자유게시글 수 획득 성공'
            ,'data' => $today_free
        ];
        return response()->json($responseData, 200);
    }

    // 오늘 문의게시판 답변 대기중 게시글 수    
    public function showTodayQuestionYet() {
        $date = Carbon::today()->toDateString();

        $today_question = Board::with('question')
                            ->where('bc_code', '2')
                            ->where('board_flg', '0')
                            ->whereHas('question', function($query) {
                                $query->where('que_status', '0');
                            })
                            ->whereDate('created_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 답변대기 문의게시글 수 획득 성공'
            ,'data' => $today_question
        ];
        return response()->json($responseData, 200);
    }
    
    // 오늘 문의게시판 답변 완료 게시글 수
    public function showTodayQuestionDone() {
        $date = Carbon::today()->toDateString();

        $today_question = Board::with('question')
                            ->where('bc_code', '2')
                            ->where('board_flg', '0')
                            ->whereHas('question', function($query) {
                                $query->where('que_status', '1');
                            })
                            ->whereDate('created_at', $date)
                            ->count();

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 답변완료 문의게시글 수 획득 성공'
            ,'data' => $today_question
        ];
        return response()->json($responseData, 200);
    }
}
