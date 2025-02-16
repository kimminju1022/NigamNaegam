<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TesterList extends Model
{
    use HasFactory, SoftDeletes;
    // 당첨된 체험단 명단
    protected $table = 'tester_lists';
    protected $primaryKey = 'tester_list_id';

    protected $fillable = [
        'board_id',
        'user_id',
        'review_chk',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function boards() {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }
}
