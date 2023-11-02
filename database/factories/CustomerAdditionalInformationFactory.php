<?php

namespace Database\Factories;

use App\Models\CustomerAdditionalInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAdditionalInformationFactory extends Factory
{
    protected $model = CustomerAdditionalInformation::class;
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
            'customer_id_type' => $this->faker->optional()->randomElement(['Type1', 'Type2', 'Type3']),
            'id_number' => $this->faker->optional()->numerify('##########'),
            'driving_license' => $this->faker->optional()->numerify('##########'),
            'image' => $this->faker->optional()->imageUrl(),
            'location' => $this->faker->optional()->latitude . ',' . $this->faker->optional()->longitude,
            'contact_person_detail' => $this->faker->optional()->name,
            'contact_person_phone' => $this->faker->optional()->phoneNumber,
            'relation' => $this->faker->optional()->word,
            'compliance_gdpr' => $this->faker->optional()->boolean,
            'sms_notification' => $this->faker->boolean,
            'email_notification' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
