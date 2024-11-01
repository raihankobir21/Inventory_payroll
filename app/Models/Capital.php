<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'remarks',
        'created_user_id',
        'modified_user_id',
        'deleted_user_id',
        'status'
    ];
}
