<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'staff_id', 'month_year', 'leave_days', 'total_days', 'created_user_id', 'modified_user_id'];

    // Each leave belongs to a user (or staff)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Each leave references off days for the same month
    public function offDay()
    {
        return $this->belongsTo(OffDay::class, 'month_year', 'month_year');
    }
}
