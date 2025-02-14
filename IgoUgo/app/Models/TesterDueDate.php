<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesterDueDate extends Model
{
    use HasFactory;
    // 체험단 기간 관리

    protected $primaryKey = 'tester_dd_id';

    protected $fillable = [
        'board_id',
        'tester_code',
        'tester_name',
        'due_date',
    ];
    
    public function boards() {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }
}
