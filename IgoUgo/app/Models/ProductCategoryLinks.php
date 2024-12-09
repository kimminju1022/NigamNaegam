<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryLinks extends Model
{
    use HasFactory;

    protected $primaryKey = 'pcl_id';

    protected $fillable = [
        'prod_id'
        ,'cc_type'
    ];
}
