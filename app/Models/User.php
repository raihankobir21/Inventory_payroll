<?php

  

namespace App\Models;

  

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

  

class User extends Authenticatable

{

    use HasFactory, Notifiable, HasRoles;

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [  
        'name',
        'mobile_no',
        'username', 
        'email', 
        'password', 
        'ip', 
        'image', 
        'status' ,
        'type',

    
        'staff_id', 
        //'name', 
        //'mobile_no', 
        'finger_1', 
        'finger_2', 
        'finger_3', 
        'finger_4', 
        'finger_5', 
        'created_user_id', 
        'modified_by', 
        'status', 
    ];

    // public function userDetails()
    // {
    //     return $this->hasOne('App\Models\UserDetail');
    // }
    public function userDetails()
    {
        return $this->hasOne('App\Models\UserDetail');
    }


    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance');
    }
	
	

    // public function employeeAccount()
    // {
    //     return $this->hasOne('App\Models\EmployeeAccount');
    // }
    public function employeeAccount()
    {
        return $this->hasOne(EmployeeAccount::class);
    }

    public function advancePayments()
    {
        // return $this->hasMany('App\Models\EmployeeAdvancePayment');
        return $this->hasMany(EmployeeAdvancePayment::class, 'user_id');
    }

    public function employeeExpense()
    {
        // return $this->hasOne(EmployeeExpense::class);
        return $this->hasMany(EmployeeExpense::class, 'user_id');
    }
    // app/Models/User.php

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function salaryCategory()
    {
        return $this->belongsTo(SalaryCategory::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'user_id');
    }



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];

  

    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

}