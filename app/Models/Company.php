<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'mobile_no',
        'email', 
        'address', 
        'created_user_id', 
        'modified_user_id', 
        
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
