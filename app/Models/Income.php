<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'amount',
        'remarks',
        'created_user_id',
        'modified_user_id',
        'deleted_user_id', 
        'count_status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
