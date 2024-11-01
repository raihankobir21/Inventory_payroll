<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRemainBalance extends Model
{
    use HasFactory; 
    
    protected $fillable = [
		'event_type',
        'event_table_name', 
        'event_table_row_id',
        'event_amount', 
        'remain_balance', 
        'created_user_id', 
        'modified_user_id', 
        'deleted_user_id',
        'status'
        
    ];
}
