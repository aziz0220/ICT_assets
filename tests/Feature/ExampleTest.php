<?php

namespace Tests\Feature;

use App\Models\SystemAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        // Create the role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'System Admin']);

        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($role);

        // Act as the user
        $this->actingAs($user);

        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
    }
}
