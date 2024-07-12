<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class StaffFactory extends Factory {
    protected $model = Staff::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'office_id' => $this->faker->randomElement(Office::pluck('id')->toArray()),
        ];
    }
}
