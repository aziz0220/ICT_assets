<?php

namespace App\Http\Controllers;

use App\Models\AssetMaintenance;
use App\Models\AssetProblem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingProblems = AssetProblem::where('is_resolved', false)->get();
        $pendingMaintenances = AssetMaintenance::where('status', 'pending')->get();

        return view('dashboard', compact('pendingProblems', 'pendingMaintenances'));
    }
}
