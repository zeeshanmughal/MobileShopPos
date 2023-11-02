<?php

namespace Database\Factories;

use App\Models\CustomerAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAddressFactory extends Factory
{
    protected $model = CustomerAddress::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'customer_id' => \App\Models\Customer::factory(),
            'street_address' => $this->faker->streetAddress,
            'house_number' => $this->faker->optional()->buildingNumber,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postcode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'location' => $this->faker->optional()->latitude . ',' . $this->faker->optional()->longitude,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
