<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomerAdditionalInformation;

class CustomerAdditionalInformationSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CustomerAdditionalInformation::factory()->count(50)->create();
    }
}
