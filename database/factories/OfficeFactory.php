<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OfficeFactory extends Factory{
    protected $model = Office::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->address,
            'head_id' => $this->faker->randomElement(Staff::pluck('id')->toArray()),
        ];
    }
}
