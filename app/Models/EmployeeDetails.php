<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id', 
        'staff_id', 
        'designation', 
        'email', 
        'nid', 
        'photo', 
        'joining_date', 
        'present_address', 
        'permanent_address', 
        'emergency_contact', 
        'blood_group', 
        'joining_salary', 
        'created_by', 
        'modified_by', 
        'status', 
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }
}

