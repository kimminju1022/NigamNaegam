<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'board_report_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'board_id',
        'board_report_flg',
        'board_comment_type',
    ]; // 다시 회의해야하지만 일단 만듦
}
