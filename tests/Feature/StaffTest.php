<?php

namespace Tests\Feature;

use App\Models\Office;
use App\Models\Staff;
use App\Models\SystemAdmin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_staff()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        // Act as the user
        $this->actingAs($user);
        // Create an office
        $office = Office::factory()->create();
        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));

        // Simulate filling the form
        $response = $this->post(route('staff.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'confirm-password' => 'password',
            'office_id' => $office->id
        ]);

        // Check the user was created
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Get the created user to check for the staff record
        $createdUser = User::where('email', 'john@example.com')->first();

        // Check the staff record was created
        $this->assertDatabaseHas('staff', [
            'office_id' => $office->id,
            'user_id' => $createdUser->id,
            'is_blocked' => 0,
        ]);

        // Ensure the staff member has the 'Staff' role
        $this->assertTrue($createdUser->hasRole('Staff'));

        // Check for the redirection
        $response->assertRedirect(route('staff.index'));
        $response->assertSessionHas('success', 'Staff member created successfully!');
    }


    /** @test */
    public  function  it_can_list_staff()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        // Act as the user
        $this->actingAs($user);
        // Create an office
        Office::factory()->create();
        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
        // Create some sample staff members
        Staff::factory()->count(3)->create();
        // Make a GET request to the index page
        $response = $this->get(route('staff.index'));
        // Ensure we get a 200 OK status
        $response->assertStatus(200);
        // Ensure the view has offices in the response
        $response->assertViewHas('staff');
    }

    /** @test */
    public function it_can_update_staff(){
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        // Act as the user
        $this->actingAs($user);
        // Create an office
        Office::factory()->create();
        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
        // Create staff member
        $staff= Staff::factory()->create();
        $office = Office::factory()->create();
        $response = $this->put(route('staff.update', $staff->id), [
            'name' => 'salah',
            'email' => 'salah@gmail.com',
            'office_id' => $office->id,
        ]);

        // Ensure the office data is updated in the database
        $this->assertDatabaseHas('staff', [
            'office_id' => $office->id,
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'salah',
            'email' => 'salah@gmail.com',
        ]);
    }

    /** @test */
    public function it_can_delete_staff(){
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        // Act as the user
        $this->actingAs($user);
        // Create an office
        Office::factory()->create();
        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
        // Create staff member
        $staff= Staff::factory()->create();
        $staff_id = $staff->id;
        $user_id = $staff->user_id;
        $response = $this->delete(route('staff.destroy', $staff_id));
        $this->assertSoftDeleted('staff', [
            'id' => $staff_id,
        ]);
        $this->assertSoftDeleted('users', [
            'id' => $user_id,
        ]);
        $response->assertRedirect(route('staff.index'));
        $response->assertSessionHas('success', 'Staff member deleted successfully!');
    }


    public function it_can_block_unblock_staff(){
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        // Act as the user
        $this->actingAs($user);
        // Create an office
        Office::factory()->create();
        // Check that the user has the role
        $this->assertTrue($user->hasRole('System Admin'));
        // Create staff member
        $staff= Staff::factory()->create();
        $staff_id = $staff->id;
        $response = $this->put(route('staff.block', $staff_id));
        $this->assertDatabaseHas('staff', [
            'id' => $staff_id,
            'is_blocked' => 1,
        ]);
        $response->assertRedirect(route('staff.index'));
        $response->assertSessionHas('success', 'Staff member blocked successfully!');
        $response = $this->put(route('staff.unblock', $staff_id));
        $this->assertDatabaseHas('staff', [
            'id' => $staff_id,
            'is_blocked' => 0,
        ]);
        $response->assertRedirect(route('staff.index'));
        $response->assertSessionHas('success', 'Staff member unblocked successfully!');
    }

    /** @test */

    public function it_can_set_head_office()
    {
        // Simulate a logged-in user
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $headrole = Role::firstOrCreate(['name' => 'Head Office']);

        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);

        // Act as the user
        $this->actingAs($user);

        // Create an office
        $office = Office::factory()->create();

        // Create a staff member and associate it with the office
        $staff = Staff::factory()->create([
            'office_id' => $office->id,
        ]);
        $staff->user->assignRole($staffRole);

        // Make a request to set the staff member as the head of the office
        $response = $this->get(route('staff.sethead', $staff->id));

        // Assert that the staff member has been set as the head
        $response->assertRedirect(route('staff.index'));
        $response->assertSessionHas('success', 'Head of office set successfully!');
        $this->assertTrue($staff->user->hasRole('Head Office'));
        $this->assertFalse($staff->user->hasRole('Staff'));
        $this->assertDatabaseHas('offices', [
            'head_id' => $staff->id,
        ]);
    }



    /** @test */
    public function it_can_set_unset_head_office()
    {
        // Simulate a logged-in user
        // Create the role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'System Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $headrole = Role::firstOrCreate(['name' => 'Head Office']);
        // Create the user and assign the role
        $user = SystemAdmin::factory()->create();
        $user->assignRole($adminRole);
        // Act as the user
        $this->actingAs($user);
        $office=Office::factory()->create();
        $this->assertTrue($user->hasRole('System Admin'));
        $staff = Staff::factory()->create([
            'office_id' => $office->id,
        ]);
        $staff->user->assignRole($staffRole);
        $response = $this->get(route('staff.unsethead', $staff->id));
        $response->assertSessionHas('error', 'This is not a head of office!');
        $response1 =$this->get(route('staff.sethead', $staff->id));
        $response1->assertRedirect(route('staff.index'));
        $response1->assertSessionHas('success', 'Head of office set successfully!');
////        $staff->user->removeRole($staffRole);
////        $staff->user->assignRole($headrole);
        $response = $this->get(route('staff.unsethead', $staff->id));
        $response->assertRedirect(route('staff.index'));
        $response->assertSessionHas('success', 'Head of office set successfully!');
        $this->assertFalse($staff->user->hasRole('Head Office'));
        $this->assertTrue($staff->user->hasRole('Staff'));
        $this->assertDatabaseHas('offices', [
            'head_id' => null,
        ]);
    }






}
