<?php

namespace App\Http\Controllers;

use App\Models\AssetMaintenance;
use App\Models\AssetProblem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingProblems = AssetProblem::with('asset')->where('is_resolved', false)->get();
        $pendingMaintenances = AssetMaintenance::with('asset')->where('status', 'pending')->get();

        return view('dashboard', compact('pendingProblems', 'pendingMaintenances'));
    }
}
