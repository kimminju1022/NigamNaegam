<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'like_id';

    public $timestamps = false;

    protected $fillable = [
        'board_id'
        ,'user_id'
        ,'like_flg'
    ];
    
    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s)
     */
    protected function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function board() {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }
    
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
