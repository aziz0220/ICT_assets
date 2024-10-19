<?php

namespace Database\Factories;

use App\Models\AssetCategory;
use App\Models\AssetStandard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssetStandardFactory extends Factory{
    protected $model = AssetStandard::class;

    public function definition(): array
    {
        return [
            'item_name' => $this->faker->randomElement(['ISO 19770-1', 'ISO/IEC 19770-5', 'ISO/IEC 19770-1']),
            'category_id' =>$this->faker->randomElement(AssetCategory::pluck('id')->toArray()),
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}

