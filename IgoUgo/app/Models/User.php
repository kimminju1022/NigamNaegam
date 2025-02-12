<?php

namespace App\Models;

use App\Notifications\MyVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasFactory, Notifiable, SoftDeletes;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manager_flg',
        'user_flg',
        'user_out',
        'user_email',
        'user_password',
        'user_name',
        'user_nickname',
        'user_phone',
        'user_profile',
        'user_last_login',
        'refresh_token',
        'email_verified_at',
        'password_reset_token',
        'password_reset_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
        'refresh_token',
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
    
    public function boards() {
        return $this->hasMany(Board::class, 'user_id', 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'board_id', 'board_id');
    }
    
    public function likes() {
        return $this->hasMany(Like::class, 'user_id', 'user_id');
    }

    public function questions(){
        return $this->hasMany(Question::class, 'user_id', 'user_id');
    }
}
