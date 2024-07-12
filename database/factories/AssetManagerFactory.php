<?php

namespace Database\Factories;

use App\Models\AssetManager;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AssetManagerFactory extends Factory{
    protected $model = AssetManager::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
