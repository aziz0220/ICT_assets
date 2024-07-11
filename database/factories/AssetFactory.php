<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_name' => fake()->domainName,
            'purchased_date' => fake()->date,
            'end_of_life' => fake()->date,
            'warrant' => fake()->text(10),
            'quantity' => fake()->numberBetween(0, 100),
            'vendor_id' => fake()->numberBetween(1, 100),
            'category_id' => fake()->numberBetween(1, 10),
            'status_id' => fake()->numberBetween(1, 5),
            'standard_id' => fake()->numberBetween(1, 10),
//            'created_by' => User::factory(),
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
