<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id', 
        'name', 
        'mobile_no', 
        'finger_1', 
        'finger_2', 
        'finger_3', 
        'finger_4', 
        'finger_5', 
        'created_by', 
        'modified_by', 
        'status', 
    ];

    public function employeeDetails()
    {
        return $this->hasOne('App\Models\EmployeeDetails');
    }

    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function employeeAccount()
    {
        return $this->hasOne('App\Models\EmployeeAccount');
    }

    public function advancePayments()
    {
        return $this->hasMany('App\Models\EmployeeAdvancePayment');
    }
}




