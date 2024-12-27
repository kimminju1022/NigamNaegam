<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'hc_id';

    protected $fillable = [
        'hotel_id',
        'pool',
        'grill',
        'fire',
        'beauty',
        'fitness',
        'pickup',
    ];

    // public function hotelCategory() {
    //     return $this->hasMany(HotelInfo::class, 'hc_type');
    // }
}
