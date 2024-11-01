<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
		'project_custom_id',
		'user_id', 'staff_id', 
		'purpose', 
        'remarks',
		'previous_in_hand', 
		'expense_amount', 
        'remain_balance', 
		'created_user_id', 
		'modified_user_id'
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
