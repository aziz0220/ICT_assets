<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $staff = Staff::with('user', 'office')->latest()->paginate($perPage, ['*'], 'staff_page');
//        $blocked = Staff::with('office','user')->where('is_blocked', true)->latest()->paginate($perPage, ['*'], 'staff_page');
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new staff member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices = Office::all();
        return view('staff.create', compact('offices')); // Assuming a staff create view
    }

    /**
     * Store a newly created staff member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'office_id' => 'required|integer',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],

        ]);
        $staff = Staff::create([
            'user_id' => $user->id,
            'office_id' => $input['office_id'],
        ]);
        $user->assignRole('Staff');

        return redirect()->route('staff.index')
            ->with('success', 'Staff member created successfully!');
    }

    /**
     * Display the specified staff member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $staff = Staff::findOrFail($id);
        $offices = Office::all();
        return view('staff.edit', compact('staff','offices')); // Assuming a staff edit view
    }

    /**
     * Update the specified staff member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $staff = Staff::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'office_id' => 'required|integer',
        ]);
        // Update User with validated data
        $staff->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
        // Update Staff with validated data
        $staff->update(['office_id' => $validatedData['office_id']]);

        return redirect()->route('staff.index')
            ->with('success', 'Staff member updated successfully!');
    }


    /**
     * Remove the specified staff member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $staff = Staff::findOrFail($id);
        $user_id = $staff->user_id;
        $staff->delete();
        $user = User::findOrFail($user_id);
        $user->removeRole('Staff');
        $user->delete();
        return redirect()->route('staff.index')
            ->with('success', 'Staff member deleted successfully!');
    }

    public function block(int $id)
    {
        $staff = Staff::findOrFail($id);
        if ($staff->is_blocked) {
            return back()->with('error', 'Staff member is already blocked!');
        }

        $staff->is_blocked = true;
        $staff->save();

        return back()->with('success', 'Staff member blocked successfully!');
    }

    public function unblock(int $id)
    {
        $staff = Staff::findOrFail($id);
        if (!$staff->is_blocked) {
            return back()->with('error', 'Staff member is already unblocked!');
        }

        $staff->is_blocked = false;
        $staff->save();

        return back()->with('success', 'Staff member unblocked successfully!');
    }



    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $staffIds = explode(',', $request->input('selected_items'));

        switch ($action) {
            case 'delete':
                foreach ($staffIds as $id) {
                    Staff::destroy($id);
                }
                break;
            case 'block':
                foreach ($staffIds as $id) {
                    Staff::block($id);
                }
                break;
            case 'unblock':
                foreach ($staffIds as $id) {
                    Staff::unblock($id);
                }
                break;
            default:
                return back()->with('error', 'Invalid action selected');
        }
        return back()->with('success', 'Bulk action performed successfully');
    }

    public function setHead (int $id) {
        $staff = Staff::findOrFail($id);
        if($staff){
        if($staff->user->hasRole('Staff')) {
            if ($staff->office->head_id) {
                if ($staff->office->head_id == $id) {
                    return back()->with('error', 'Staff member is already head of office!');
             }
                return back()->with('error', 'Office already has a head!');
            }
            $staff->user->removeRole('Staff');
            $staff->user->assignRole('Head Office');
            $staff->office->head_id = $staff->id;
            $staff->office->save();
            return redirect()->route('staff.index')
                ->with('success', 'Head of office set successfully!');
        }
        else if($staff->user->hasRole('Head Office')){
            return back()->with('error', 'Already a head of office!');
        }
        return back()->with('error', 'System Internal Fail!');
    }
    else
    {
        return back()->with('error', 'Staff member not found!');
    }
    }

    public function unSetHead (int $id)
    {
        $staff = Staff::findOrFail($id);

        if ($staff->user->hasRole('Head Office')) {
            if (!$staff->office->head_id) {
                if ($staff->office->head_id != $id) {
                    return back()->with('error', 'Staff member is not head of office!');
                }
                return back()->with('error', 'Office has no head!');
            }
            $staff->user->removeRole('Head Office');
            $staff->user->assignRole('Staff');
            $staff->office->head_id = null;
            $staff->office->save();
            return redirect()->route('staff.index')
                ->with('success', 'Head of office set successfully!');
        } else if ($staff->user->hasRole('Staff')) {
            return back()->with('error', 'This is not a head of office!');
        }
        return back()->with('error', 'System Internal Fail!');
    }
}
