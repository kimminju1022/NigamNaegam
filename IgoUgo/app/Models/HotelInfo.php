<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelInfo extends Model
{
    use HasFactory;

    protected $primaryKey = 'hotel_info_id';

    protected $fillable = [
        'hotel_id',
        'hc_id',
    ];
}
