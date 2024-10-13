<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory{
    protected $model = Asset::class;

    public function definition(): array
    {
        $purchasedDate = fake()->dateTimeBetween('-10 years', 'now');
        $endOfLife = fake()->dateTimeBetween($purchasedDate, '+10 years');

        return [
            'asset_name' => fake()->domainName,
            'purchased_date' => $purchasedDate,
            'end_of_life' => $endOfLife,
            'warrant' => fake()->text(10),
            'quantity' => fake()->numberBetween(1, 100),
            'is_registered' => fake()->boolean(),
            'head_approval' => fake()->boolean(),
            'office_id' => fake()->numberBetween(1, 10),
            'vendor_id' => fake()->numberBetween(1, 100),
            'category_id' => fake()->numberBetween(1, 10),
            'status_id' => fake()->numberBetween(1, 5),
            'standard_id' => fake()->numberBetween(1, 10),
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}

