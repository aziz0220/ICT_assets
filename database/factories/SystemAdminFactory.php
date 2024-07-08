<?php

namespace Database\Factories;

use App\Models\SystemAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SystemAdminFactory extends UserFactory{
    protected $model = SystemAdmin::class;

}
