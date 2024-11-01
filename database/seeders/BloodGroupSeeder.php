<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [   
            'A+',
            'A-',
            'B+',
            'B-',
            'O+',
            'O-',
            'AB+',
            'AB-'
        ];
		
	
		//dd($data);

        foreach ($data as $d) {
				
				//dd($d);
              BloodGroup::create([ 'name' => $d] );
             
        }
    }
}
