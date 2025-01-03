<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelInfo extends Model
{
    use HasFactory;

    protected $primaryKey = 'hotel_info_id';

    public $timestamps = false;

    protected $fillable = [
        'hotel_id',
        'hc_type',
    ];

    // public function hotel() {
    //     return $this->belongsTo(Hotel::class, 'hotel_id');
    // }
    
    // public function hotelCategory() {
    //     return $this->belongsTo(HotelCategory::class, 'hc_type');
    // }
}
