<?php

namespace Tests\Feature;
use App\Models\Office;
use App\Models\Staff;
use App\Models\SystemAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;




class OfficeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create necessary roles
        Role::create(['name' => 'Staff']);
        Role::create(['name' => 'Head Office']);
        Role::create(['name' => 'System Admin']);
    }

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

    /** @test */
    public function it_assigns_staff_to_an_office()
    {
        $role = Role::firstOrCreate(['name' => 'System Admin']);

        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($role);

        // Act as the user
        $this->actingAs($user);

        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));

        $office = Office::factory()->create();
        $staff = Staff::factory()->create();
        $office1 = Office::factory()->create();

        $response = $this->post(route('offices.assignStaff', $office), [
            'staff_id' => $staff->id,
        ]);

        $response->assertRedirect(route('offices.show', $office));
        $response->assertSessionHas('success', 'Staff assigned to office successfully.');

//        $this->assertDatabaseHas('staff', [
//            'id' => $staff->id,
//            'office_id' => $office->id,
//        ]);

        $response1 = $this->post(route('offices.assignStaff', $office1), [
            'staff_id' => $staff->id,
        ]);

        $response1->assertRedirect(route('offices.show', $office1));
        $response1->assertSessionHas('error', 'Staff already assigned to an office.');

        $this->assertDatabaseHas('staff', [
            'id' => $staff->id,
            'office_id' => $office->id,
        ]);
    }


//    /** @test */
    public function it_updates_staff_for_an_office()
    {
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $headRole = Role::firstOrCreate(['name' => 'Head Office']);

        // Create the admin user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        $this->actingAs($user);

        // Create an office
        $office = Office::factory()->create();

        // Create two staff members and assign 'Staff' role
        $staff1 = Staff::factory()->create();
        $staff2 = Staff::factory()->create();
        $staff1->user->assignRole('Staff');
        $staff2->user->assignRole('Staff');

        // Assign staff1 to the office
        $staff1->office()->associate($office)->save();

        // Update office staff with staff2 only
        $response = $this->post(route('offices.updateOfficeStaff', $office), [
            'staff_ids' => [$staff2->id],
        ]);

        // Assert that staff2 is now assigned to the office, and staff1 is removed
        $this->assertDatabaseHas('staff', [
            'id' => $staff2->id,
            'office_id' => $office->id,
        ]);
        $this->assertDatabaseMissing('staff', [
            'id' => $staff1->id,
            'office_id' => $office->id,
        ]);

        // Assert response redirect and success message
        $response->assertRedirect(route('offices.show', $office));
        $response->assertSessionHas('success', 'Office staff updated successfully.');

        // Test trying to assign Head Office staff to an office
        $headStaff = Staff::factory()->create();
        $headStaff->user->assignRole('Head Office');

        $response = $this->post(route('offices.updateOfficeStaff', $office), [
            'staff_ids' => [$headStaff->id],
        ]);

        $response->assertRedirect(route('offices.show', $office));
        $response->assertSessionHas('error', 'Cannot assign Head Office staff to an office.');

        // Verify staff in another office cannot be reassigned
        $otherOffice = Office::factory()->create();
        $staff3 = Staff::factory()->create(['office_id' => $otherOffice->id]);
        $staff3->user->assignRole('Staff');

        $response = $this->post(route('offices.updateOfficeStaff', $office), [
            'staff_ids' => [$staff3->id],
        ]);

        $response->assertRedirect(route('offices.show', $office));
        $response->assertSessionHas('error', 'Some staff are already assigned to another office.');
    }



//
//    /** @test */
//    public function test_set_head_office()
//    {
//        // Create a user and associate it with a staff member
//        $user = User::factory()->create();
//        $staff = Staff::factory()->create(['user_id' => $user->id]);
//        // Assign 'Staff' role to the user
//        $user->assignRole('Staff');
//        // Create an office
//        $office = Office::factory()->create();
//        // Make a request to set this staff member as the head of the office
//        $response = $this->post(route('offices.setHead', $office), [
//            'staff_id' => $staff->id,
//        ]);
//        // Refresh the office and staff instances to get the latest data
//        $office = $office->fresh();
//        $staff->user->refresh();
//        // Assert that the office now has the correct head
//        $this->assertEquals($staff->id, $office->head_id);
//        // Assert that the user's role has been updated
//        $this->assertTrue($staff->user->hasRole('Head Office'));
//        $this->assertFalse($staff->user->hasRole('Staff'));
//        // Assert the response redirects and contains success message
//        $response->assertRedirect(route('offices.show', $office));
//        $response->assertSessionHas('success', 'Head office updated successfully.');
//    }

}
