<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $offices = Office::with('headOffice.user')->paginate($perPage, ['*'], 'staff_page');
        $staff = Staff::with('user')->where('office_id', '')->get();
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new office.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'html' => view('offices.partials.add_new_row')->render(),
            ]);
        }

        return view('offices.partials.add_new_row');
    }


    /**
     * Store a newly created office in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $office = Office::create($validated);
        if ($request->expectsJson()) {
            return response()->json([
                'html' => view('offices.partials.office_row', compact('office'))->render(),
            ]);
        }
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
        if (request()->expectsJson()) {
            return view('offices.partials.edit_office_row', compact('office'));
        }

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

        if ($request->expectsJson()) {
            return response()->json([
                'html' => view('offices.partials.office_row', compact('office'))->render()
            ]);
        }

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

        // Check if the staff has the role 'Staff' and remove it
        if ($staff->user->hasRole('Staff')) {
            $staff->user->removeRole('Staff');
            $staff->user->assignRole('Head Office');
        }

        // Associate the staff with the office as head
        $office->headOffice()->associate($staff);
        $office->save();

        return redirect()->route('offices.show', $office)
            ->with('success', 'Head office updated successfully.');
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

//        if ($staff->user->hasRole('Head Office')) {
//            return redirect()->route('offices.show', $office)->with('error', 'Head office cannot be assigned to an office.');
//        }
//
        if ($staff->office_id !== null) {
            return redirect()->route('offices.show', $office)->with('error', 'Staff is already assigned to another office.');
        }


//        $staff->office_id = $office->id;
////
////        $staff->office()->associate($office);
////        $staff->save();

        // Ensure success message is returned
        return redirect()->route('offices.show', $office)->with('success', 'Staff assigned to office successfully.');
    }


// Method to edit office staff
public function editStaffOffice(Request $request, Office $office)
{
    $staff = Staff::with('user')->get();
    //consider fixing the view
    return view('offices.editstaff', compact('office', 'staff'));
}

// Method to update office staff
    public function updateOfficeStaff(Request $request, Office $office)
    {
        $request->validate([
            'staff_ids' => 'required|array',
            'staff_ids.*' => 'exists:staff,id',
        ]);

        $staffIds = $request->staff_ids;

        // Remove staff not in the provided list
        $office->staff()->whereNotIn('id', $staffIds)->update(['office_id' => null]);
        // Add each staff ID to the office
        foreach ($staffIds as $staffId) {
            $staff = Staff::find($staffId);
            if ($staff->user->hasRole('Head Office')) {
                return redirect()->route('offices.show', $office)
                    ->with('error', 'Cannot assign Head Office staff to an office.');
            }
            if ($staff->office_id && $staff->office_id !== $office->id) {
                return redirect()->route('offices.show', $office)
                    ->with('error', 'Some staff are already assigned to another office.');
            }
            // Reassign staff to the office
            $staff->office()->associate($office);
            $staff->save();
        }
        return redirect()->route('offices.show', $office)->with('success', 'Office staff updated successfully.');
    }



    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $assetIds = explode(',', $request->input('selected_items'));
        switch ($action) {
            case 'delete':
                foreach ($assetIds as $id) {
                    Office::destroy($id);
                }
                break;
            default:
                return back()->with('error', 'Invalid action selected');
        }
        return back()->with('success', 'Bulk action performed successfully');
    }

}
