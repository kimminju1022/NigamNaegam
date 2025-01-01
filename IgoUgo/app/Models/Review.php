<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'board_id',
        'area_code',
        'rc_type',
        'rate',
    ];

    public function review_categories() {
        return $this->belongsTo(ReviewCategory::class, 'rc_type', 'rc_type');
    }

    public function boards() {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }

    public function areas() {
        return $this->belongsTo(Area::class, 'area_code', 'area_code');
    }
}
