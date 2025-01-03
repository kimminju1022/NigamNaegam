<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $primaryKey = 'area_id';

    protected $guarded = [
        'area_code',
        'area_name',
        'area_rnum',
    ];

    // public function review() {
    //     return $this->hasOne(Review::class, 'area_code', 'area_code');
    // }
}
