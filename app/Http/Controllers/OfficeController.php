<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Staff;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the offices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::with('headOffice')->get();
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
        return view('offices.show', compact('office','staff'));
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
        $office->save();

        return redirect()->route('offices.show', $office)->with('success', 'Head office updated successfully.');
    }

    public function removeHead(Office $office)
    {
        $office->headOffice()->dissociate();
        $office->save();

        return redirect()->route('offices.show', $office)->with('success', 'Head office removed successfully.');
    }



}
