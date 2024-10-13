<?php

namespace Database\Factories;

use App\Models\AssetCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssetCategoryFactory extends Factory{
    protected $model = AssetCategory::class;

    public function definition(): array
    {
        return [
            'category_name' => $this->faker->randomElement([
                'Software',
                'Hardware',
                'Networking Equipment',
                'Servers',
                'Printers',
                'Projectors'
            ]),
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}

