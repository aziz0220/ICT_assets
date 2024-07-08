<?php

namespace Database\Factories;

use App\Models\AssetStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssetStatusFactory extends Factory{
    protected $model = AssetStatus::class;

    public function definition(): array
    {
        return [
            'status_name' => $this->faker->word,
            'created_by' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
