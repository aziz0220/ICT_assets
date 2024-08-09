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

        return redirect()->route('dashboard.index')->with('success', 'Problem reported successfully.');
    }

    public function show($id)
    {
        // You can either redirect to the index page
        return redirect()->route('asset_problems.index');

        // Or return a view if you have a detailed page for the asset problem
        $problem = AssetProblem::with('asset')->findOrFail($id);
        return view('asset_problems.show', compact('problem'));
    }

    public function destroy($id)
    {
        $problem = AssetProblem::findOrFail($id);
        $problem->delete();
        return redirect()->route('dashboard.index')->with('success', 'Problem removed successfully.');
    }

    public function approve($id)
    {
        $problem = AssetProblem::findOrFail($id);
        $problem->is_approved = true;
        $problem->save();

        return redirect()->route('dashboard.index')->with('success', 'Problem approved successfully.');
    }

    public function resolve($id)
    {
        $problem = AssetProblem::findOrFail($id);
        $problem->is_resolved = true;
        $problem->save();

        return redirect()->route('dashboard.index')->with('success', 'Problem resolved successfully.');
    }

}
