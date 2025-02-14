<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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
            if($today) {
                return $date->format('H:i');
            } else {
                return $date->format('Y-m-d');
            }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id')->select('user_id', 'user_name', 'user_nickname', 'user_profile');
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

    public function product() {
        return $this->hasOneThrough(Product::class, Review::class, 'board_id', 'product_id', 'board_id', 'product_id');
    }
    
    public function review_category() {
        // return $this->hasOneThrough(ReviewCategory::class, Review::class, 'board_id', 'rc_type', 'board_id', 'rc_type');
        return $this->hasOneThrough(ReviewCategory::class, Review::class, 'board_id', 'bc_code', 'board_id', 'bc_code');
    }
    
    public function board_images(){
        return $this->hasMany(BoardImage::class, 'board_id', 'board_id');
    }

    public function reports(){
        // return $this->hasMany(BoardReport::class,'board_id', 'user_id', 'board_id', 'user_id'); 
        return $this->hasMany(BoardReport::class,'board_id', 'board_id'); 
    }

    public function tester_lists(){
        return $this->hasMany(TesterManagement::class, 'board_id', 'board_id');
    }

    public function tester_managements(){
        return $this->hasOne(TesterDueDate::class, 'board_id', 'board_id');
    }
}
