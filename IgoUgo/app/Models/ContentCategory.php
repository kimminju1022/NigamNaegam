<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentCategory extends Model
{
    protected $primaryKey = 'cc_id';

    protected $fillable = [
        'cc_type'
        ,'cc_name'
    ];
}
