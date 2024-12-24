<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'board_id';

    protected $fillable = [
        'user_id',
        'bc_id',
        'board_title',
        'board_content',
        'board_img1',
        'board_img2',
        'view_cnt',
    ];

    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s')
     */
    protected function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id')->select('user_id', 'user_nickname');
    }

    public function board_categories() {
        return $this->belongsTo(BoardCategory::class, 'bc_type', 'bc_type');
    }

    public function questions() {
        return $this->hasMany(Question::class, 'board_id', 'board_id');
    }
}
