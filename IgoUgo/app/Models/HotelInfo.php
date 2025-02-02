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
        'product_id',
        // 'hc_type',
        'hc_code',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function hotelCategory() {
        return $this->belongsTo(HotelCategory::class, 'hc_code');
    }
}
