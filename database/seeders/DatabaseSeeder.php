<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetManager;
use App\Models\AssetStandard;
use App\Models\AssetStatus;
use App\Models\Staff;
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

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        foreach ($this->permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
        $staffRole = Role::create(['name' => 'Staff']);
        $staffRole->syncPermissions($this->staffPermissions);

        $assetManagerRole = Role::create(['name' => 'Asset Manager']);
        $assetManagerRole->syncPermissions($this->assetManagerPermissions);

        $systemAdminRole = Role::create(['name' => 'System Admin']);


        $executiveRole = Role::create(['name' => 'Executive Manager']);

        Vendor::factory(100)->create();
        Asset::factory(100)->create();

        $assetManagers = AssetManager::factory(2)->create();
        foreach ($assetManagers as $assetManager) {
            $assetManager->assignRole($assetManagerRole);
        }
        $staff = Staff::factory(15)->create();
        foreach ($staff as $staffMember) {
            $staffMember->assignRole($staffRole);
        }
        AssetStatus::factory(5)->create();
        AssetStandard::factory(20)->create();
        AssetCategory::factory(40)->create();

    }
}
