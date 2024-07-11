<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class StaffFactory extends UserFactory {
    protected $model = Staff::class;

    public function definition(): array
    {
        return array_merge(parent::definition(), [
            'office_id' => $this->faker->randomElement(Office::pluck('id')->toArray()),
        ]);
    }
}
