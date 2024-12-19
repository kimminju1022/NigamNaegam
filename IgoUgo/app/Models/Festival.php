<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class festival extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'festivals';
    protected $primaryKey = 'festival_id';
    
    protected $guarded = [
        'title'
        ,'addr1'
        ,'addr2'
        ,'tel'
        ,'areacode'
        ,'booktour'
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
        ,'eventstartdate'
        ,'eventenddate'
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
