<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'board_img_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'board_id',
        'board_img',
    ];
}
