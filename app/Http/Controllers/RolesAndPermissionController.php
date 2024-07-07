<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionController extends Controller
{
    //
    public function addPermission(Request $request)
    {
        $permissions = [
            'Request New Asset',
            'Request Asset Change',
            'Request Asset Problem',
            'Request Asset Maintainance',
            'Manage Asset Standards',
            'Manage Asset Vendor',
            'Register New Asset',
            'Manage Asset Categories',
            'Manage Asset Status',
            'Generate Custom Report',
            'Manage Role',
            'Manage Permission',
            'Block Staff'
        ];
        // $permission = Permission::create(['name' => $request->name]);
        foreach ($permissions as $permission){
            $permission = Permission::create(['name' => $permission]);
        }
        return response()->json(['message' => 'Permission created successfully', 'data' => $permission]);
    }


    public function createRole(Request $request){
        $role = Role::create(['name' => $request->name]);

        foreach ($request->permission as $permission){
            $role->givePermissionTo($permission);
        }

        foreach ($request->users as $user){
            $user = User::find($user);
            $user->assignRole($role->name);
        }
        return redirect('show-roles');

    }

}
