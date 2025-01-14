<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'notice_img_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'notice_id',
        'notice_img',
    ];
}
