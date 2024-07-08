<?php

namespace Database\Factories;

use App\Models\AssetStandard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssetStandardFactory extends Factory{
    protected $model = AssetStandard::class;

    public function definition(): array
    {
        return [
            'item_name' => $this->faker->word,
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
