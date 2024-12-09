<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelsCategory extends Model
{
    protected $primaryKey = 'hc_id';

    protected $fillable = [
        'hc_type'
        ,'hc_name'
    ];
}
