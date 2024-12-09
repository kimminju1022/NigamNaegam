<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelsCategoryLink extends Model
{
    use HasFactory;

    protected $primaryKey = 'hcl_id';

    protected $fillable = [
        'hotel_id'
        ,'hc_type'
    ];
}
