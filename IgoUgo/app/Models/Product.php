<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    
    protected $guarded = [
        'title'
        ,'addr1'
        ,'addr2'
        ,'tel'
        ,'area_code'
        // ,'benikia'
        // ,'booktour'
        // ,'goodstay'
        // ,'hanok'
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

    public function hotel_infos() {
        return $this->hasMany(HotelInfo::class, 'product_id', 'product_id');
    }
    
    public function reviews() {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }
    
    public function area() {
        return $this->belongsTo(Area::class, 'area_code', 'area_code');
    }
}
