<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'hc_id';

    protected $fillable = [
        // 'hc_type',
        'hc_code',
        'hc_name',
    ];

    public function hotelCategory() {
        // return $this->hasMany(HotelInfo::class, 'hc_type');
        return $this->hasMany(HotelInfo::class, 'hc_code');
    }
}
