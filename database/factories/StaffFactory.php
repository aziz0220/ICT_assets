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
        $officeIds = Office::pluck('id')->toArray();
        $officeIds[] = null;
        return [
            'user_id' => function () {
                return User::factory()->create([
                    'password' => bcrypt('password'),
                ])->id;
            },
            'office_id' => $this->faker->randomElement($officeIds),
        ];
    }
}
