<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesterDueDate extends Model
{
    use HasFactory;
    // 체험단 장소 관리

    protected $primaryKey = 'tester_id';

    protected $fillable = [
        'board_id',
        'tester_code',
        'tester_name',
        'due_date',
        'tester_place',
        'tester_area',
    ];
    
    public function boards() {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }
}
