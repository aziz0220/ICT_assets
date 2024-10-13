<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OfficeFactory extends Factory
{
    protected $model = Office::class;

    public function definition(): array
    {
        // Define office names with corresponding locations
        $offices = [
            'Dar es Salaam Campus' => 'Dar es Salaam',
            'Mwanza Regional Centre' => 'Mwanza',
            'Arusha Regional Centre' => 'Arusha',
            'Mbeya Regional Centre' => 'Mbeya',
            'Dodoma Regional Centre' => 'Dodoma',
        ];

        // Pick a random office name and get its corresponding location
        $name = $this->faker->randomElement(array_keys($offices));
        $location = $offices[$name];

        return [
            'name' => $name,
            'location' => $location,
            'head_id' => $this->faker->randomElement(Staff::pluck('id')->toArray()),
        ];
    }
}
