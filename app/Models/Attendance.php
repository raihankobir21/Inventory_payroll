<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'staff_id', 
		
        'present_salary', 
        'payable_salary', 
        'total_working_hour', 
		
        'created_user_id', 
        'modified_user_id', 
        'status', 
        'exit_time', 
        'late_consider', 
		'remarks'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}





