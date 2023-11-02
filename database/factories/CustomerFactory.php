<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'uuid' => $this->faker->uuid,
            'slug' => $this->faker->slug,
            'customer_group' => $this->faker->word,
            'organization' => $this->faker->optional()->company,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->optional()->lastName,
            'email' => $this->faker->optional()->safeEmail,
            'phone' => $this->faker->optional()->phoneNumber,
            'how_did_you_hear_us' => $this->faker->optional()->sentence,
            'walk_in_customer' => $this->faker->boolean,
            'network' => $this->faker->optional()->word,
            'tax_class' => $this->faker->optional()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
