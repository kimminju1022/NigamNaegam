<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'bc_id';

    protected $fillable = [
        'bc_type'
        ,'bc_name'
    ];
}
