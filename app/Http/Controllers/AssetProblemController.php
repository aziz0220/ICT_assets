<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMaintenance;
use App\Models\AssetProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetProblemController extends Controller
{

    public function index()
    {
        $totalAssets = Asset::count();
        $pendingProblems = AssetProblem::with('asset')->where('is_resolved', false)->get();
        $pendingMaintenances = AssetMaintenance::with('asset')->where('status', 'pending')->get();
        return view('dashboard', compact('pendingProblems', 'pendingMaintenances','totalAssets'));
    }

    public function store(Request $request, $assetId)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        AssetProblem::create([
            'asset_id' => $assetId,
            'description' => $request->description,
            'is_resolved' => false,
            'issued_by' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Problem reported successfully.');
    }
}
