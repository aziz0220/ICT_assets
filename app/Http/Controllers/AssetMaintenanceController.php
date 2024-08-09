<?php

namespace App\Http\Controllers;

use App\Models\AssetMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetMaintenanceController extends Controller
{


    public function store(Request $request, $id)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'description' => 'required|string|max:255'
        ]);

        AssetMaintenance::create([
            'asset_id' => $id,
            'description' => $request->description,
            'issued_by' => Auth::User()->id,
        ]);

        return redirect()->route('assets.index')->with('success', 'Maintenance request submitted successfully.');
    }


    public function destroy($id)
    {
        $maintenance = AssetMaintenance::findOrFail($id);
        $maintenance->delete();
        return redirect()->route('dashboard.index')->with('success', 'Maintenance removed successfully.');
    }

    public function approve($id)
    {
        $maintenance = AssetMaintenance::findOrFail($id);
        $maintenance->is_approved = true;
        $maintenance->save();

        return redirect()->route('dashboard.index')->with('success', 'Maintenance approved successfully.');
    }

    public function resolve($id)
    {
        $maintenance = AssetMaintenance::findOrFail($id);
        $maintenance->status = 'resolved';
        $maintenance->save();

        return redirect()->route('dashboard.index')->with('success', 'Maintenance resolved successfully.');
    }
}
