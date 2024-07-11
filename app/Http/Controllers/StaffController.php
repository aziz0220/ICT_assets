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
        $staff = Staff::with('office')->latest()->paginate(50);
        return view('staff.index', compact('staff')); // Assuming a staff index view
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

        $staff = Staff::create($input);
//        $user->assignRole('Staff');
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
    public function update(
//      StaffRequest $request,
        int $id ,// Use StaffRequest for validation
        Request $request
    )
    {
        $staff = Staff::findOrFail($id);
//        $staff->update($request->validated()); // Use validated data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'office_id' => 'required|integer',
        ]);
        $staff->update($validatedData);
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
        return redirect()->route('staff.index')
            ->with('success', 'Staff member deleted successfully!');
    }

    public function blockStaff(){

    }

    public function unblockStaff(){

    }


}
