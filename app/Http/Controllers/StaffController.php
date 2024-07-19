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
    public function index()
    {
        $staff = Staff::with('office','user')->where('is_blocked', false)->latest()->paginate(50);
        $blocked = Staff::with('office','user')->where('is_blocked', true)->latest()->paginate(50);
        return view('staff.index', compact('staff','blocked'));
    }

    /**
     * Show the form for creating a new staff member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {          $offices = Office::all();
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

        $user->assignRole('Staff');
        $staff = Staff::create([
            'user_id' => $user->id,
            'office_id' => $input['office_id'],
        ]);
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
        return view('staff.show', compact('staff')); // Assuming a staff show view
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
        $staff->user->update($validatedData);

        // Update Staff (optional, if additional staff-specific fields need update)
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
        $staff->delete();
        $user = User::findOrFail($staff->user_id);
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

    public function setHead (int $id, Office $office_id) {
        $office = Office::findOrFail($office_id);
        $staff = Staff::findOrFail($id);
        if ($office->head_office_id == $id) {



        }

        $staff->is_head = true;
        $staff->save();
        return redirect()->route('staff.index')
            ->with('success', 'Head of office set successfully!');
    }



}
