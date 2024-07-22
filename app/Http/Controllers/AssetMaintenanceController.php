<?php

namespace App\Http\Controllers;

use App\Models\AssetMaintenance;
use Illuminate\Http\Request;

class AssetMaintenanceController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        AssetMaintenance::create([
            'asset_id' => $id,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Maintenance request submitted successfully.');
    }
}
