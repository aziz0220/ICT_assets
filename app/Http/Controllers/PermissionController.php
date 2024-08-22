<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class PermissionController extends Controller
{
    use HasRoles;

    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $permissions = Permission::orderBy('id', 'DESC')->paginate($perPage, ['*'], 'users_page');
        return view('permissions.index', compact('permissions')); // Assuming a permissions index view
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create'); // Assuming a permissions create view
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name|max:255',
        ]);

        $permission = Permission::create(['name' => $request->input('name')]);

        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified permission.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        return view('permissions.show', compact('permission')); // Assuming a permissions show view
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public  function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission')); // Assuming a permissions edit view
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$id.'|max:255',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $assetIds = explode(',', $request->input('selected_items'));

        switch ($action) {
            case 'delete':
                foreach ($assetIds as $id) {
                    User::destroy($id);
                }
                break;
            default:
                return back()->with('error', 'Invalid action selected');
        }

        return back()->with('success', 'Bulk action performed successfully');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Permission::destroy($id);
        return redirect()->route('permission.index')
            ->with('success', 'Permission deleted successfully');
    }
}
