<?php

namespace Tests\Feature;
use App\Models\Office;
use App\Models\SystemAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OfficeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_office()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'System Admin']);

        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($role);

        // Act as the user
        $this->actingAs($user);

        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
        // Simulate filling the form
        $response = $this->post(route('offices.store'), [
            'name' => 'Dar es Salaam Campus',
            'location' => 'Dar es Salaam',
        ]);

        // Check the office was created
        $this->assertDatabaseHas('offices', [
            'name' => 'Dar es Salaam Campus',
            'location' => 'Dar es Salaam',
        ]);

        // Check for the redirection
        $response->assertRedirect(route('offices.index'));
        $response->assertSessionHas('success', 'Office created successfully.');
    }



    /** @test */
    public function it_can_list_offices()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'System Admin']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($role);
        // Act as the user
        $this->actingAs($user);
        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
        // Create some sample offices
        Office::factory()->count(3)->create();
        // Make a GET request to the index page
        $response = $this->get(route('offices.index'));
        // Ensure we get a 200 OK status
        $response->assertStatus(200);
        // Ensure the view has offices in the response
        $response->assertViewHas('offices');
    }

    /** @test */
    public function it_can_update_an_office()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'System Admin']);

        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($role);

        // Act as the user
        $this->actingAs($user);

        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));

        // Create an office
        $office = Office::factory()->create([
            'name' => 'Old Office',
            'location' => 'Old Location',
        ]);

        // Update the office
        $response = $this->put(route('offices.update', $office->id), [
            'name' => 'New Office',
            'location' => 'New Location',
        ]);

        // Ensure the office data is updated in the database
        $this->assertDatabaseHas('offices', [
            'name' => 'New Office',
            'location' => 'New Location',
        ]);

        // Ensure we were redirected
        $response->assertRedirect(route('offices.index'));
        $response->assertSessionHas('success', 'Office updated successfully.');
    }

    /** @test */
    public function it_can_delete_an_office()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'System Admin']);

        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($role);

        // Act as the user
        $this->actingAs($user);

        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));

        // Create an office
        $office = Office::factory()->create();

        // Delete the office
        $response = $this->delete(route('offices.destroy', $office->id));

        // Ensure the office is no longer in the database
        $this->assertDatabaseMissing('offices', ['id' => $office->id]);

        // Ensure we were redirected
        $response->assertRedirect(route('offices.index'));
        $response->assertSessionHas('success', 'Office deleted successfully.');
    }


}
