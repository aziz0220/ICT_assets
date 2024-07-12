<?php

namespace Database\Factories;

use App\Models\ExecutiveManagement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ExecutiveManagementFactory extends Factory{
    protected $model = ExecutiveManagement::class;


    public function definition(): array
    {

        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
