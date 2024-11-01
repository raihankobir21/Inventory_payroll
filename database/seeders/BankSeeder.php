<?php

namespace Database\Seeders;
use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [   
            'Premier',
            'Dutch Bangla',
            'City',
            'UCB',
            'Islami',
            'Bkash',
            'Nagad',
            'Rocket',
            'Upai'
        ];
		
	
		//dd($data);

        foreach ($data as $d) {
				
				//dd($d);
              Bank::create([ 'name' => $d] );
             
        }
    }
}
