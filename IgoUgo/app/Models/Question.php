<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class question extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'que_id';

    protected $fillable = [
        'board_id',
        'que_content',
        'que_status',
    ];
}
