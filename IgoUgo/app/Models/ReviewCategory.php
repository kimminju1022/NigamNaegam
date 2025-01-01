<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'rc_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rc_name',
        'rc_type',
    ];

    public function reviews() {
        return $this->hasOne(Review::class, 'rc_type', 'rc_type');
    }
}
