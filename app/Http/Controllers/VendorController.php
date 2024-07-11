<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the vendors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created vendor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required|string|max:255',
            'vendor_shortname' => 'required|string|max:50|unique:vendors,vendor_shortname', // Ensure unique short names
        ]);

        if ($validator->fails()) {
            return redirect()->route('vendors.create')
                ->withErrors($validator)
                ->withInput();
        }

        $vendor = new Vendor;
        $vendor->vendor_name = $request->vendor_name;
        $vendor->vendor_shortname = $request->vendor_shortname;
        $vendor->created_by = Auth::id(); // Set created_by to currently authenticated user

        $vendor->save();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor created successfully!');
    }

    /**
     * Display the specified vendor.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified vendor.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified vendor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required|string|max:255',
            'vendor_shortname' => 'required|string|max:50|unique:vendors,vendor_shortname,' . $id, // Unique excluding self
        ]);

        if ($validator->fails()) {
            return redirect()->route('vendors.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $vendor = Vendor::findOrFail($id);
        $vendor->vendor_name = $request->vendor_name;
        $vendor->vendor_shortname = $request->vendor_shortname;

        $vendor->save();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor updated successfully!');
    }

    /**
     * Remove the specified vendor from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor deleted successfully!');
    }
}
