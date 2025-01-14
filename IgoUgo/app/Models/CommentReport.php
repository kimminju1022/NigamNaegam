<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'comment_report_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'comment_id',
        'comment_report_flg',
    ]; // 다시 회의해야하지만 일단 만듦
}
