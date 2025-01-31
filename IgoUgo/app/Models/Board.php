<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'board_id';

    protected $fillable = [
        'user_id',
        'board_flg',
        // 'bc_type', 2nd
        'bc_code',
        'board_title',
        'board_content',
        'view_cnt',
    ];

    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d')
     */
    protected function serializeDate(\DateTimeInterface $date) {
        $today = Carbon::instance($date)->isToday();
        // $manager = User::where('manager_flg' === '1')->all(); // 매니저 여부 체크
        
        // if(!$manager) {
            if($today) {
                return $date->format('H:i');
            } else {
                return $date->format('Y-m-d');
            } // 매니저가 아닐 경우 보드리스트에서 보일 시간
        // } else {
            // return $date->format('Y-m-d H:i:s'); // 매니저일 경우 관리자사이트에서 보일 시간
        // }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id')->select('user_id', 'user_nickname');
    }

    public function board_category() {
        // return $this->belongsTo(BoardCategory::class, 'bc_type', 'bc_type');
        return $this->belongsTo(BoardCategory::class, 'bc_code', 'bc_code');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'board_id', 'board_id');
    }

    public function question() {
        return $this->hasOne(Question::class, 'board_id', 'board_id');
    }

    public function question_category() {
        return $this->hasOne(QuestionCategory::class, 'board_id', 'board_id');
    }

    public function likes() {
        return $this->hasMany(Like::class, 'board_id', 'board_id')->where('like_flg', 1);
    }

    public function review() {
        return $this->hasOne(Review::class, 'board_id', 'board_id');
    }

    public function area() {
        return $this->hasOneThrough(Area::class, Review::class, 'board_id', 'area_code', 'board_id', 'area_code');
    }
    
    public function review_category() {
        // return $this->hasOneThrough(ReviewCategory::class, Review::class, 'board_id', 'rc_type', 'board_id', 'rc_type');
        return $this->hasOneThrough(ReviewCategory::class, Review::class, 'board_id', 'bc_code', 'board_id', 'bc_code');
    }
    
    public function route() {
        return $this->hasOne(Route::class, 'board_id', 'board_id');
    }

    public function route_spots() {
        return $this->hasManyThrough(RouteSpot::class, Route::class, 'board_id', 'route_id', 'board_id', 'route_id');
    }
    
    public function board_images(){
        return $this->hasMany(BoardImage::class, 'board_id', 'board_id');
    }

    public function report(){
        return $this->hasMany(BoardReport::class,'board_id', 'user_id', 'board_id', 'user_id'); 
    }
    
    /*public function getBoardContentname(Request $request) {
        $board = Board::find($request->id);
        
        // rcName 변환 로직
        $rcNameMapping = [
            '1' => '게시글 유형 A',
            '2' => '게시글 유형 B',
            '3' => '게시글 유형 C',
            // ... 실제 매핑 데이터 추가
        ];
    
        $board->rcName = $rcNameMapping[$board->rcName] ?? '알 수 없는 유형';
    
        return response()->json($board);
    }*/
}
