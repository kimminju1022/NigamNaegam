<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotels';
    protected $primaryKey = 'hotel_id';
    
    protected $guarded = [
        'title'
        ,'addr1'
        ,'addr2'
        ,'tel'
        ,'area_code'
        ,'benikia'
        ,'booktour'
        ,'goodstay'
        ,'hanok'
        ,'cat1'
        ,'cat2'
        ,'cat3'
        ,'contentid'
        ,'contenttypeid'
        ,'firstimage'
        ,'firstimage2'
        ,'cpyrhtdivcd'
        ,'mapx'
        ,'mapy'
        ,'mlevel'
        ,'sigungucode'
        ,'createdtime'
        ,'modifiedtime'
    ];

    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s)
     */
    protected function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function hotelCategories() {
        return $this->hasManyThrough(HotelCategory::class, HotelInfo::class, 'hotel_id', 'hc_type', 'hotel_id', 'hc_type');
    }
    
    // Hotel.php
    public function hotelInfos() {
        return $this->hasMany(HotelInfo::class, 'hotel_id', 'hotel_id');
    }
}