<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetManager;
use App\Models\ExecutiveManagement;
use App\Models\Office;
use App\Models\Staff;
use App\Models\SystemAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $data = User::latest()->paginate($perPage, ['*'], 'users_page');
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $offices = Office::all();
        return view('users.create',compact('roles','offices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        Log::log('info', $request->input('roles'));
        foreach ($request->input('roles') as $role) {
            switch ($role) {
                case 'System Admin':
                    SystemAdmin::create([
                        'user_id' => $user->id,
                    ]);
                    break;
                case 'Staff':
                    Staff::create([
                        'user_id' => $user->id,
                        'office_id' => $request->input('office_id'),
                    ]);
                    break;
                case 'Asset Manager':
                    AssetManager::create([
                        'user_id' => $user->id,
                    ]);
                    break;
                case 'Executive Manager':
                    ExecutiveManagement::create([
                        'user_id' => $user->id,
                    ]);
                    break;
            }
        }

        return redirect()->route('user.index')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->first();
        $offices = Office::all();
        return view('users.edit',compact('user','roles','userRole','offices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success','User updated successfully');
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
     * Remove the specified staff member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        foreach ($user->roles->pluck('name')->all() as $role)
        {
            $user->removeRole($role);
        }
        $user->delete();
        return redirect()->route('user.index')
            ->with('success','User deleted successfully');
    }


    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        if ($request->file('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
            $user->save();
        }

        return back()->with('success', 'Profile picture updated successfully!');
    }


}
