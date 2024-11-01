<?php

namespace Database\Seeders;

use App\Models\SalaryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   
		
		$data[] = [ 'title' => 'Day Basis With Overtime', 'basic_working_hour_start' => '9 am','basic_working_hour_end' => '5 pm', 
		'calculation_process' => '9am to 5pm = Basic salary, 9am to 9pm = salary*1.5, 9pm to 11.50pm = salary*2,  after 11.50pm will be count per hourly based on salary', 'basic_working_hour' => '8', 'type' => 1 ];
		
		$data[] = [ 'title' => 'Monthly Basis with Overtime', 'basic_working_hour_start' => '9 am', 'basic_working_hour_end' => '6 pm', 
		'calculation_process' => '9 to 6 fixed salary, After 6 pm to 11:50pm per hour 30 tk., then  after 11.50pm will be count per hourly based on salary', 'basic_working_hour' => '9', 'type' => 2 ];
		
		$data[] = [ 'title' => 'Day Basis without Overtime', 'basic_working_hour_start' => '9 am', 'basic_working_hour_end' => '9 pm', 
		'calculation_process' => NULL, 'basic_working_hour' => '12', 'type' => 3 ];
		
		$data[] = [ 'title' => 'Monthly  Basis without Overtime', 'basic_working_hour_start' => '9 am', 'basic_working_hour_end' => '9 pm', 
		'calculation_process' => NULL, 'basic_working_hour' => '12', 'type' => 4 ];
		
	
		//dd($data);

        foreach ($data as $d) {
				
				//dd($d);
              SalaryCategory::create($d);
             
        }
    }
}
