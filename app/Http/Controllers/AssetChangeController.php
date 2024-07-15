<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetChange;
use App\Models\AssetStandard;
use App\Models\AssetStatus;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetchanges = AssetChange::latest()->paginate(50);
        return view('assetChanges.index', compact('assetchanges',));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        AssetChange::create([
            'asset_name' => $request->asset_name,
            'purchased_date' => $request->purchased_date,
            'end_of_life' => $request->end_of_life,
            'warrant' => $request->warrant,
            'quantity' =>$request->quantity,
            'vendor_id' => $request->vendor_id,
            'category_id' => $request->category_id,
            'standard_id' => $request->standard_id,
            'status_id' => $request->status_id,
            'created_by' => Auth::User()->id,
        ]);
        return redirect()->route('assets.index')
            ->with('success','Asset Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
