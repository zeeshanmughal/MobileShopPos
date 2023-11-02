<?php

namespace Database\Seeders;

use App\Models\CustomerAddress;
use Illuminate\Database\Seeder;

class CustomerAddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CustomerAddress::factory()->count(50)->create();
    }
}
