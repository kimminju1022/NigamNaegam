<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TesterManagement extends Model
{
    use HasFactory, SoftDeletes;
    // 체험단 장소 관리
    protected $table = 'tester_managements';
    protected $primaryKey = 'tester_id';

    protected $fillable = [
        'board_id',
        'tester_code',
        'tester_name',
        'tester_place',
        'tester_area',
        'due_date',
    ];
        
    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s')
     */
    protected function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function boards() {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }
}
