<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'bc_id';

    protected $fillable = [
        'bc_type',
        'bc_name',
        'user_id',
        'board_title',
        'board_content',
        'board_img1',
        'board_img2',
    ];

    public function boards() {
        return $this->hasMany(Board::class, 'bc_type');
    }
}
