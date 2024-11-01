<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 
        'staff_id',
        'bank_id', 
        'branch_name', 
        'account_name', 
        'account_number', 
        'created_by', 
        'modified_by', 
    ];
    
        public function user()
    {
        return $this->belongsTo(User::class);
    }


}






