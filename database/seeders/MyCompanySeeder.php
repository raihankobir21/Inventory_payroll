<?php

namespace Database\Seeders;

use App\Models\MyCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MyCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = MyCompany::create([
		
            'name' => 'Fast Sign Interior', 
            'short_name' => 'FSI', // this name need for project id generate
            'mobile' => '01759978395',
            'email' => 'info@fastsigninterior.com',
            'address'   => 'Said Nagar, Auto Stand, Vatara',
            'logo'   => 'Said Nagar, Auto Stand, Vatara',
            'signature_holder_name'   => 'Papon Banik',
            'signature_holder_designation'   => 'Chairman',
            'signature'   => 'signature.jpg',
			
        ]);
		
		
    }
}
