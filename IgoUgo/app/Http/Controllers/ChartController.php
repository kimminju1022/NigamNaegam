<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    // 일일 가입회원 수
    public function showDailySignUp() {
        $start_date = Carbon::today()->subDay(4)->startOfDay();
        $end_date = Carbon::today()->endOfDay();

        $dates = [];
        $currentDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $today_user = User::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day, COUNT(*) as cnt"))
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->groupBy('day')
                            ->get();

        // 날짜 목록에 맞춰 빈 데이터를 추가
        $all_dates = collect($dates);
        $today_user = $all_dates->map(function ($date) use ($today_user) {
            $data = $today_user->firstWhere('day', $date);
            return [
                'day' => $date,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true
            ,'msg' =>'일일 가입회원 수 획득 성공'
            ,'data' => $today_user
        ];
        return response()->json($responseData, 200);
    }

    // // 한 달 가입회원 수
    // public function showMonthlySignUp() {
    //     Log::debug('함수 실행');
    //     $date_start = Carbon::today()->startOfMonth()->toDateString();
    //     $date_end = Carbon::today()->endOfMonth()->toDateString();

    //     Log::debug($date_start);

    //     $monthly_user = User::whereBetween('created_at', [$date_start, $date_end])
    //                         ->count();

    //     $responseData = [
    //         'success' => true
    //         ,'msg' =>'한 달 가입회원 수 획득 성공'
    //         ,'data' => $monthly_user
    //     ];
    //     return response()->json($responseData, 200);
    // }
    
    // 일일 탈퇴회원 수
    public function showDailyDeletedAccount() {
        $start_date = Carbon::today()->subDay(4)->startOfDay();
        $end_date = Carbon::today()->endOfDay();

        $dates = [];
        $currentDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $today_user = User::select(DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') as day, COUNT(*) as cnt"))
                            ->whereBetween('updated_at', [$start_date, $end_date])
                            ->where('user_flg', '1')
                            ->groupBy('day')
                            ->get();

        // 날짜 목록에 맞춰 빈 데이터를 추가
        $all_dates = collect($dates);
        $today_user = $all_dates->map(function ($date) use ($today_user) {
            $data = $today_user->firstWhere('day', $date);
            return [
                'day' => $date,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true
            ,'msg' =>'일일 탈퇴회원 수 획득 성공'
            ,'data' => $today_user
        ];
        return response()->json($responseData, 200);
    }

    // 일일 리뷰게시판 게시글 수
    public function showDailyReview() {
        $start_date = Carbon::today()->subDay(4)->startOfDay();
        $end_date = Carbon::today()->endOfDay();

        $dates = [];
        $currentDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $today_review    = Board::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day, COUNT(*) as cnt"))                
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->where('bc_code', '0')
                            ->where('board_flg', '0')
                            ->groupBy('day')
                            ->get();

        // 날짜 목록에 맞춰 빈 데이터를 추가
        $all_dates = collect($dates);
        $today_review = $all_dates->map(function ($date) use ($today_review) {
            $data = $today_review->firstWhere('day', $date);
            return [
                'day' => $date,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 리뷰게시글 수 획득 성공'
            ,'data' => $today_review
        ];
        return response()->json($responseData, 200);
    }

    // 일일 자유게시판 게시글 수    
    public function showDailyFree() {
        $start_date = Carbon::today()->subDay(4)->startOfDay();
        $end_date = Carbon::today()->endOfDay();

        $dates = [];
        $currentDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $today_free  = Board::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day, COUNT(*) as cnt"))                
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->where('bc_code', '1')
                            ->where('board_flg', '0')
                            ->groupBy('day')
                            ->get();

        // 날짜 목록에 맞춰 빈 데이터를 추가
        $all_dates = collect($dates);
        $today_free = $all_dates->map(function ($date) use ($today_free) {
            $data = $today_free->firstWhere('day', $date);
            return [
                'day' => $date,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 자유게시글 수 획득 성공'
            ,'data' => $today_free
        ];
        return response()->json($responseData, 200);
    }

    // 일일 문의게시판 답변 대기중 게시글 수    
    public function showDailyQuestionYet() {
        $start_date = Carbon::today()->subDay(4)->startOfDay();
        $end_date = Carbon::today()->endOfDay();

        $dates = [];
        $currentDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $today_question  = Board::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day, COUNT(*) as cnt"))                
                            ->with('question')
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->where('bc_code', '2')
                            ->where('board_flg', '0')
                            ->whereHas('question', function($query) {
                                $query->where('que_status', '0');
                            })
                            ->groupBy('day')
                            ->get();

        // 날짜 목록에 맞춰 빈 데이터를 추가
        $all_dates = collect($dates);
        $today_question = $all_dates->map(function ($date) use ($today_question) {
            $data = $today_question->firstWhere('day', $date);
            return [
                'day' => $date,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true
            ,'msg' =>'일일 답변대기 문의게시글 수 획득 성공'
            ,'data' => $today_question
        ];
        return response()->json($responseData, 200);
    }
    
    // 일일 문의게시판 답변 완료 게시글 수
    public function showDailyQuestionDone() {
        $start_date = Carbon::today()->subDay(4)->startOfDay();
        $end_date = Carbon::today()->endOfDay();

        $dates = [];
        $currentDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $today_question  = Board::select(DB::raw("DATE_FORMAT(updated_at, '%Y-%m-%d') as day, COUNT(*) as cnt"))                
                            ->with('question')
                            ->whereBetween('updated_at', [$start_date, $end_date])
                            ->where('bc_code', '2')
                            ->where('board_flg', '0')
                            ->whereHas('question', function($query) {
                                $query->where('que_status', '1');
                            })
                            ->groupBy('day')
                            ->get();

        // 날짜 목록에 맞춰 빈 데이터를 추가
        $all_dates = collect($dates);
        $today_question = $all_dates->map(function ($date) use ($today_question) {
            $data = $today_question->firstWhere('day', $date);
            return [
                'day' => $date,
                'cnt' => $data ? $data->cnt : 0,
            ];
        });

        $responseData = [
            'success' => true
            ,'msg' =>'오늘 답변완료 문의게시글 수 획득 성공'
            ,'data' => $today_question
        ];
        return response()->json($responseData, 200);
    }
}
