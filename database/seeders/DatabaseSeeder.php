<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetManager;
use App\Models\AssetStandard;
use App\Models\AssetStatus;
use App\Models\ExecutiveManagement;
use App\Models\Office;
use App\Models\Staff;
use App\Models\SystemAdmin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vendor;
use Database\Factories\AssetCategoryFactory;
use Database\Factories\AssetFactory;
use Database\Factories\AssetManagerFactory;
use Database\Factories\AssetStandardFactory;
use Database\Factories\AssetStatusFactory;
use Database\Factories\StaffFactory;
use Database\Factories\VendorFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{

//    private $roles = [
//        'Staff',
//        'Asset Manager',
//        'System Admin',
//        'Executive Manager',
//        'Super-Admin'
//    ];
    private $permissions = [
        'Request-New-Asset',
        'Request-Asset-Change',
        'Request-Asset-Problem',
        'Request-Asset-Maintainance',
        'Manage-Asset-Standards',
        'Manage-Asset-Vendor',
        'Register-New-Asset',
        'Manage-Asset-Categories',
        'Manage-Asset-Status',
        'Generate-Custom-Report',
        'Manage-Role',
        'Manage-Permission',
        'Block-Staff'
    ];

    private $staffPermissions = [
        'Request-New-Asset',
        'Request-Asset-Change',
        'Request-Asset-Problem',
        'Request-Asset-Maintainance',
    ];
    private $assetManagerPermissions = [
        'Manage-Asset-Standards',
        'Manage-Asset-Vendor',
        'Register-New-Asset',
        'Manage-Asset-Categories',
        'Manage-Asset-Status',
        'Generate-Custom-Report',
    ];
    private $executiveManagerPermissions = [
        'Generate-Custom-Report',
    ];
    private $systemAdminPermissions = [
        'Manage-Role',
        'Manage-Permission',
        'Block-Staff'
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Reset Permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        foreach ($this->permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }


        // ADMIN account

        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        // Database Seeding
        Vendor::factory(100)->create();
        AssetStatus::factory(5)->create();
        AssetCategory::factory(40)->create();
        AssetStandard::factory(20)->create();
        Asset::factory(100)->create();
        Office::factory(10)->create();
        $assetManagers = AssetManager::factory(2)->create();
        $executiveManager = ExecutiveManagement::factory()->create();
        $systemAdmin = SystemAdmin::factory()->create();
        $staff = Staff::factory(15)->create();

        //Creating Roles:
        $staffRole = Role::create(['name' => 'Staff']);
        $assetManagerRole = Role::create(['name' => 'Asset Manager']);
        $systemAdminRole = Role::create(['name' => 'System Admin']);
        $executiveRole = Role::create(['name' => 'Executive Manager']);

        //Assigning Roles:

        foreach ($assetManagers as $assetManager) {
            $assetManager->assignRole($assetManagerRole);
        }

        foreach ($staff as $staffMember) {
            $staffMember->assignRole($staffRole);
        }

        $executiveManager->assignRole($executiveRole);

        $systemAdmin->assignRole($systemAdminRole);

        $admin->assignRole($systemAdminRole);


        //Sync Permissions to Roles
        $staffRole->syncPermissions($this->staffPermissions);
        $assetManagerRole->syncPermissions($this->assetManagerPermissions);
        $systemAdminRole->syncPermissions($this->systemAdminPermissions);
        $executiveRole->syncPermissions($this->executiveManagerPermissions);

    }
}
