<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssetStatusController extends Controller
{
    /**
     * Display a listing of the asset statuses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetstatuses = AssetStatus::latest()->paginate(10); // Paginate results (10 per page)
        return view('assetStatuses.index', compact('assetstatuses'));
    }

    /**
     * Show the form for creating a new asset status.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assetStatuses.create');
    }

    /**
     * Store a newly created asset status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_name' => 'required|string|max:255|unique:asset_statuses,status_name', // Unique validation
        ]);

        if ($validator->fails()) {
            return redirect()->route('asset-status.create')
                ->withErrors($validator)
                ->withInput();
        }

        $assetStatus = AssetStatus::create([
            'status_name' => $request->status_name,
            'created_by' => Auth::id()
        ]);
        return redirect()->route('asset-status.index')
            ->with('success', 'Asset Status created successfully!');
    }

    /**
     * Display the specified asset status.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $assetStatus = AssetStatus::findOrFail($id);
        return view('assetStatuses.show', compact('assetStatus'));
    }

    /**
     * Show the form for editing the specified asset status.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $assetStatus = AssetStatus::findOrFail($id);
        return view('assetStatuses.edit', compact('assetStatus'));
    }

    /**
     * Update the specified asset status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status_name' => 'required|string|max:255|unique:asset_statuses,status_name,'.$id, // Unique validation excluding self
        ]);

        if ($validator->fails()) {
            return redirect()->route('asset-status.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $assetStatus = AssetStatus::findOrFail($id);
        $assetStatus->update(
            [
                'status_name' => $request->status_name,
            ]
        );
        return redirect()->route('asset-status.index')
            ->with('success', 'Asset Status updated successfully!');
    }

//    public function softDelete(string $id)
//    {
//        $assetStatus = AssetStatus::findOrFail($id);
//        if ($assetStatus->asset->count() > 0) {
//            return redirect()->route('asset-status.index')
//                ->with('error', 'Cannot delete asset status with associated assets');
//        }
////        $assetStatus->soft
//        return redirect()->route('asset-status.index')
//            ->with('success', 'Asset Status soft deleted successfully!');
//    }

    /**
     * Remove the specified asset status from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $assetStatus = AssetStatus::findOrFail($id);

        // Check if any assets are associated with this status before deletion
        if ($assetStatus->asset->count() > 0) {
            return redirect()->route('asset-status.index')
                ->with('error', 'Cannot delete asset status with associated assets');
        }

        $assetStatus->delete();
        return redirect()->route('asset-status.index')
            ->with('success', 'Asset Status deleted successfully!');
    }
}

