<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'qc_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'board_id',
        // 'qc_type',
        'qc_code',
        'qc_name',
    ];

    public $timestamps = false;

    public function board() {
        return $this->belongsTo(Board::class, 'board_id');
    }
}
