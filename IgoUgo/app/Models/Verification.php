<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Verification extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'verified_email_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_email',
        'hash_email',
        'email_expires_at',
        'email_verifeid_at',
    ];
}
