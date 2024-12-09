<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $primaryKey = 'local_id';

    protected $fillable = [
        'local_type'
        ,'local_name'
    ];
}
