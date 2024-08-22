<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMaintenance;
use App\Models\AssetProblem;
use App\Models\Office;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $offices = Office::count();

        $totalAssets = Asset::count();
        $pendingProblems = AssetProblem::with('asset','asset.vendor','asset.category','asset.standard','asset.status')->where('is_resolved', false)->where('is_approved',true)->get();
        $pendingMaintenances = AssetMaintenance::with('asset','asset.vendor','asset.category','asset.standard','asset.status')->where('status', 'pending')->where('is_approved',true)->get();
        if(auth()->user()->hasRole('Staff|Head Office')) {
            $pendingProblems = AssetProblem::with('asset', 'asset.vendor', 'asset.category', 'asset.standard', 'asset.status')->where('is_resolved', false)->where('is_approved', false)->get();
            $pendingMaintenances = AssetMaintenance::with('asset', 'asset.vendor', 'asset.category', 'asset.standard', 'asset.status')->where('status', 'pending')->where('is_approved', false)->get();
        }
        $vendors = Vendor::all();
 return view('dashboard', compact('pendingProblems', 'pendingMaintenances','totalAssets','vendors','offices'));
    }
}
