<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'user_id',
        'board_id',
        'comment_content',
    ];

    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d')
     * if made it today
     * @return String('H:i')
     * 
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
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
