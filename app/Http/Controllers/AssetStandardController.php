<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetStandard;

class AssetStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetStandards = AssetStandard::with('category')->latest()->paginate(50);
        return view('assetStandards.index', compact('assetStandards')); // Pass data to view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assetStandards.create'); // Return the create view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $assetStandard = AssetStandard::create($validatedData); // Create a new AssetStandard

        return redirect()->route('asset-standard.index')
            ->with('success', 'Asset Standard created successfully!'); // Redirect with success message
    }

    /**
     * Display the specified resource.
     *
     * @param  AssetStandard  $assetStandard
     * @return \Illuminate\Http\Response
     */
    public function show(AssetStandard $assetStandard)
    {
        return view('assetStandards.show', compact('assetStandard')); // Pass data to view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AssetStandard  $assetStandard
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetStandard $assetStandard)
    {
        return view('assetStandards.edit', compact('assetStandard')); // Pass data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  AssetStandard  $assetStandard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetStandard $assetStandard)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $assetStandard->update($validatedData); // Update the AssetStandard

        return redirect()->route('asset-standard.show', $assetStandard->id)
            ->with('success', 'Asset Standard updated successfully!'); // Redirect with success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AssetStandard  $assetStandard
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetStandard $assetStandard)
    {
        $assetStandard->delete(); // Soft delete the AssetStandard

        return redirect()->route('asset-standard.index')
            ->with('success', 'Asset Standard deleted successfully!'); // Redirect with success message
    }
}
