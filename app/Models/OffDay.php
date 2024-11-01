<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'off_days',
        'total_days',
        'remain_working_days',
        'month_year',
        'created_user_id',
        'modified_user_id',
        'deleted_user_id',
        'status',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'month_year', 'month_year');
    }

}
