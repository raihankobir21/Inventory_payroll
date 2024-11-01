<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Md. Raihan Kobir', 
            'email' => 'raihanpustcse21@gmail.com',
            'username' => 'inventory_payroll',
            'password' => bcrypt('12345678'),
            'type'   => 0
        ]);
    
       // $role = Role::create(['name' => 'Super Admin(Technical)']);
		
		 $role = Role::create([
			'name' => 'Super Admin(Technical)', 
			'order' => 1
		]);

     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
