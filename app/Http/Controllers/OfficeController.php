<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OfficeController extends Controller
{
    /**
     * Display a listing of the offices.
     *
     * @return \Illuminate\Http\Response
     */


    private $headOfficePermissions = [
        'approve_new_asset',
        'approve_edit_asset',
        'approve_maintenance',
        'approve_problem'
    ];
    public function index()
    {
        $offices = Office::with('headOffice.user')->get();
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new office.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offices.create');
    }

    /**
     * Store a newly created office in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Office::create($request->all());

        return redirect()->route('offices.index')->with('success', 'Office created successfully.');
    }

    /**
     * Display the specified office.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        $staff = Staff::with('user')->where('office_id', $office->id)->get();
        return view('offices.show', compact('office', 'staff'));
    }

    /**
     * Show the form for editing the specified office.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        $staff = Staff::with('user')->where('office_id', $office->id)->get();
        return view('offices.edit', compact('office', 'staff'));
    }

    /**
     * Update the specified office in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'head_office_id' => 'nullable|exists:staff,id',
        ]);

        if($request->head_office_id != $office->head_id){
            $request->staff_id = $request->head_office_id;
            $this->setHead($request, $office);
        }
        $office->update($request->all());
        return redirect()->route('offices.index')->with('success', 'Office updated successfully.');
    }

    /**
     * Remove the specified office from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('offices.index')->with('success', 'Office deleted successfully.');
    }

    public function setHead(Request $request, Office $office)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
        ]);
        $staff = Staff::find($request->staff_id);
        $office->headOffice()->associate($staff);
        $staff->user->removeRole('Staff');
        $staff->user->assignRole('Head Office');
        $office->save();
        return redirect()->route('offices.show', $office)->with('success', 'Head office updated successfully.');
    }

    public function removeHead(Office $office)
    {
        $staff = Staff::findOrFail($office->head_id);
        $office->headOffice()->dissociate();
        $staff->user->removeRole('Head Office');
        $staff->user->assignRole('Staff');
        $office->save();
        return redirect()->route('offices.show', $office)->with('success', 'Head office removed successfully.');
    }



// Method to show form to assign staff to an office
    public function assignStaffForm(Office $office)
    {
        $staff = Staff::with('user')->whereNull('office_id')->get();
        return view('offices.assignstaff', compact('office', 'staff'));
    }

// Method to assign staff to an office
    public function assignStaff(Request $request, Office $office)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
        ]);
        $staff = Staff::find($request->staff_id);
        $staff->office()->associate($office);

        $staff->save();
        return redirect()->route('offices.show', $office)->with('success', 'Staff assigned to office successfully.');
    }

// Method to edit staff office
    public function editStaffOffice(Request $request, Staff $staff)
    {
        $offices = Office::all();
        return view('staff.editoffice', compact('staff', 'offices'));
    }

// Method to update staff office
    public function updateStaffOffice(Request $request, Staff $staff)
    {
        $request->validate([
            'office_id' => 'nullable|exists:offices,id',
        ]);
        $staff->office()->associate($request->office_id);
        $staff->save();
        return redirect()->route('staff.show', $staff)->with('success', 'Staff office updated successfully.');
    }
}
