<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 
        'staff_id', 
        'designation', 
        //'email', 
        'nid', 
        'photo', 
        'joining_date', 
        'present_address', 
        'permanent_address', 
        'emergency_contact', 
        'blood_group',
        'salary_caregory_id',
        'joining_salary', 
        'created_by', 
        'modified_by', 
        'status', 
    ];

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User', 'user_id');
    // }
        public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    
  

}
