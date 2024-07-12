<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\SystemAdmin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SystemAdminFactory extends Factory{
    protected $model = SystemAdmin::class;

    public function definition(): array
    {

        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
