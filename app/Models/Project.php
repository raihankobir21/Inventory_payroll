<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 
        //'project_custom_id', 
        'name', 
        'description', 
        'created_user_id', 
        'modified_user_id', 
        'deleted_user_id', 
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
