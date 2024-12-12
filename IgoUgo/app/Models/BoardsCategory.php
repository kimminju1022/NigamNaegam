<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardsCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'bc_id';

    protected $fillable = [
        'bc_type'
        ,'bc_name'
    ];
}
