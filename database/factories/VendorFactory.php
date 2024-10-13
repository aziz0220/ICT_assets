<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory{
    protected $model = Vendor::class;

    public function definition(): array
    {
        return [
            'vendor_name' => fake()->randomElement([
                'DarCom',
                'TanzTech Supplies',
                'SmartCom Solutions',
                'Mwanza ICT Vendors',
                'TechSavvy Tanzania'
            ]),
            'vendor_shortname' => fake()->unique()->biasedNumberBetween(1, 10000),
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
