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
        ,'areacode'
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
}