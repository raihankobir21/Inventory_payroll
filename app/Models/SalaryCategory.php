<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'basic_working_hour_start', 'basic_working_hour_end', 'calculation_process', 'type', 'status' ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, salary_category_id);
    }
}
