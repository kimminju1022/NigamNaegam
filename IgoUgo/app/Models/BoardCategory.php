<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'bc_id';

    protected $fillable = [
        // 'bc_type',
        'bc_code',
        'bc_name',
    ];

    public function boards() {
        // return $this->hasMany(Board::class, 'bc_type');
        return $this->hasMany(Board::class, 'bc_code');
    }
}
