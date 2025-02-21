<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserControl extends Model
{
    use HasFactory, SoftDeletes;
    // 유저 제재 이력
    protected $table = 'user_controls';
    protected $primaryKey = 'control_id';

    protected $fillable = [
        'user_id',
        'expires_at',
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
    
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
