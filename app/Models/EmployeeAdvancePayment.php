<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAdvancePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
		'project_custom_id',
		'user_id',
        'staff_id', 
        'purpose',
        'amount',
        'type',
        'status',
        'created_by', 
        'modified_by', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
	
	public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    
}
