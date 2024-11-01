<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		
		$data = [
			
			'Admin(Technical)', 
			'Chairman', 
			'Director', 
			'Admin(Office)', 
			'General Employee', 
			
		] ;
       // dd($data);
		$count = 2;
		foreach ($data as $key => $d) {
			
			Role::create( ['name' => $d, 'guard_name' => 'web', 'order' => $count++, 'dropdown_show' => 1] );

		}
    }
	
	
}
