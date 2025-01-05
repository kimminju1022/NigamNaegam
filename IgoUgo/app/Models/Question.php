<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'que_id';

    protected $fillable = [
        'board_id',
        'que_content',
        'que_status',
    ];

    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s)
     */
    protected function serializeDate(\DateTimeInterface $date) {
        $today = Carbon::instance($date)->isToday();
        if($today) {
            return $date->format('H:i');
        } else {
            return $date->format('Y-m-d');
        }
    }

    public function board() {
        return $this->belongsTo(Board::class, 'board_id');
    }
}
