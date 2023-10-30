<?php

namespace Database\Seeders;

use App\Models\PaymentPlan;
use Illuminate\Database\Seeder;

class PaymentPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $basicPlan = PaymentPlan::create([
            'name' => 'Basic Plan',
            'description' => 'Basic subscription plan with essential features',
            'price' => 50,
            'interval' => 'monthly',
        ]);

        $standardPlan = PaymentPlan::create([
            'name' => 'Standard Plan',
            'description' => 'Standard subscription plan with additional features',
            'price' => 100,
            'interval' => 'monthly',
        ]);

        $premiumPlan = PaymentPlan::create([
            'name' => 'Premium Plan',
            'description' => 'Premium subscription plan with advanced features',
            'price' => 150,
            'interval' => 'monthly',
        ]);

        // You can also add additional features for each plan
        $basicPlan->features()->createMany([
            ['feature_detail' => 'Description for Basic Feature 1'],
            ['feature_detail' => 'Description for Basic Feature 2'],
        ]);

        $standardPlan->features()->createMany([
            ['feature_detail' => 'Description for Standard Feature 1'],
            ['feature_detail' => 'Description for Standard Feature 2'],
            ['feature_detail' => 'Description for Standard Feature 3'],

        ]);

        $premiumPlan->features()->createMany([
            ['feature_detail' => 'Description for Premium Feature 1'],
            ['feature_detail' => 'Description for Premium Feature 2'],
            ['feature_detail' => 'Description for Premium Feature 3'],
            ['feature_detail' => 'Description for Premium Feature 4'],

        ]);
    }
}     
