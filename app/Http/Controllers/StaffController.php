<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Http\Requests\StaffRequest; // Import StaffRequest for validation (optional)

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
    {
        return view('staff.create'); // Assuming a staff create view
    }

    /**
     * Store a newly created staff member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request) // Use StaffRequest for validation
    {
        $staff = Staff::create($request->validated()); // Use validated data
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
        return view('staff.edit', compact('staff')); // Assuming a staff edit view
    }

    /**
     * Update the specified staff member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, int $id) // Use StaffRequest for validation
    {
        $staff = Staff::findOrFail($id);
        $staff->update($request->validated()); // Use validated data
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

    // Additional staff functionalities

    public function requestAssetChange()
    {
        // Implement logic for staff to request asset change
        // This might involve a form, interaction with the Asset model, etc.
        return view('staff.requestAssetChange'); // Assuming a request asset change view
    }

    public function reportAssetProblem()
    {
        // Implement logic for staff to report asset problem
        // This might involve a form, interaction with the Asset model, etc.
        return view('staff.reportAssetProblem'); // Assuming a report asset problem view
    }

    public function requestAssetMaintainance()
    {
        // Implement logic for staff to request asset maintenance
        // This might involve a form, interaction with the Asset model, etc.
        return view('staff.requestAssetMaintainance'); // Assuming a request asset maintenance view
    }

    public function requestNewAsset()
    {
        // Implement logic for staff to request new asset
        // This might involve a form, interaction with the Asset model, etc.
        return view('staff.requestNewAsset'); // Assuming a request new asset view
    }
}
