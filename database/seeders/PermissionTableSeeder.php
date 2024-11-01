<?php

  

namespace Database\Seeders;

  

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

  

class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {
		$permissions['Role'] = ['role-list', 'role-create', 'role-edit', 'role-delete'] ;
        $permissions['Role']['order'] = 1;
		
		$permissions['User-Employee'] = ['user-employee-list', 'user-employee-create', 'user-employee-edit', 'user-employee-delete', 'user-employee-active-inactive'] ;
        $permissions['User-Employee']['order'] = 2;
		
		$permissions['Project Advance payment'] = ['project-advance-payment-list', 'project-advance-payment-create', 'project-advance-payment-edit', 'project-advance-payment-delete'] ;
        $permissions['Project Advance payment']['order'] = 3;
		
		$permissions['Expense'] = ['expense-list', 'expense-create', 'expense-edit', 'expense-delete'] ;
        $permissions['Expense']['order'] = 4;
		
		$permissions['Salary Category'] = ['salary-category-list', 'salary-category-create', 'salary-category-edit', 'salary-category-delete'] ;
        $permissions['Salary Category']['order'] = 5;
		
		$permissions['Atentance'] = ['atentance-in', 'atentance-exit'] ;
        $permissions['Atentance']['order'] = 6;
		
		$permissions['Report'] = ['today-atentance', 'date-wise-atentance', 'today-expense', 'date-wise-expense'] ;
        $permissions['Report']['order'] = 7;
		
       
     

		foreach ($permissions as $key => $parentPer) {
			
			foreach ($parentPer as $key2 =>  $permission) {
            
				if( $key2 != 'order' )
				{
					Permission::create( ['section_name' => $key, 'name' => $permission] );

				}else{
					
					//$orderInpur['order'] = $permission;
				
					$orderUpdate = Permission::where('section_name', $key)
					->update([
					   'order' => $permission
					]);
					
					
				}
			}
        }
		
		
		
		
		

    }

}

?>