<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetChange;
use App\Models\AssetStandard;
use App\Models\AssetStatus;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function store(Request $request,$id)
    {
        AssetChange::create([
            'asset_id' => fake()->randomElement(Asset::pluck('id')->toArray()),
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
    public function edit(AssetChange $assetchange)
    {
        $vendors = Vendor::pluck('vendor_name', 'id');
        $categories = AssetCategory::pluck('category_name', 'id');
        $statuses = AssetStatus::pluck('status_name', 'id');
        $standards = AssetStandard::pluck('item_name', 'id');

        return view('assetChanges.edit', compact('assetchange', 'vendors', 'categories', 'statuses', 'standards'));
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'asset_name' => 'required|string|max:255',
            'purchased_date' => 'required|date',
            'end_of_life' => 'required|date',
            'warrant' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'vendor_id' => 'required|integer',
            'category_id' => 'required|integer',
            'standard_id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);

        $assetChange = AssetChange::find($id);

        if ($assetChange) {
            $assetChange->update($validatedData);
            return redirect()->route('assets.index')
                ->with('success', 'Asset updated successfully.');
        } else {
            return redirect()->route('assets.index')
                ->with('error', 'Asset not found.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assetChange = AssetChange::find($id);
        if ($assetChange) {
            $assetChange->delete();
            return redirect()->route('assets.index')
                ->with('success', 'Asset deleted successfully.');
        } else {
            return redirect()->route('assets.index')
                ->with('error', 'Asset not found.');
        }
    }
}
