<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMaintenance;
use App\Models\AssetManager;
use App\Models\AssetProblem;
use App\Models\ExecutiveManagement;
use App\Models\Office;
use App\Models\Staff;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $vendors = [];
        $offices = Office::count();
        $users = User::count();
        $staff = Staff::count();
        $admins = User::role('System Admin')->count();
        $executives = ExecutiveManagement::count();
        $assetManagers =AssetManager::count();
        $roles = Role::pluck('name');
        $unasignedStaff = Staff::with('office')->whereDoesntHave('office')->count();
        $unroledUsers = User::with('roles')->whereDoesntHave('roles')->count();
        $totalAssets = Asset::count();
        $pendingProblems = AssetProblem::with('asset','asset.vendor','asset.category','asset.standard','asset.status')->where('is_resolved', false)->where('is_approved',true)->get();
        $pendingMaintenances = AssetMaintenance::with('asset','asset.vendor','asset.category','asset.standard','asset.status')->where('status', 'pending')->where('is_approved',true)->get();
        if(auth()->user()->hasRole('Staff|Head Office')) {
            $pendingProblems = AssetProblem::with('asset', 'asset.vendor', 'asset.category', 'asset.standard', 'asset.status')->where('is_resolved', false)->where('is_approved', false)->get();
            $pendingMaintenances = AssetMaintenance::with('asset', 'asset.vendor', 'asset.category', 'asset.standard', 'asset.status')->where('status', 'pending')->where('is_approved', false)->get();
        }

        $officesStaffCount = Office::withCount('staff')->get()->pluck('staff_count', 'name');

        // Fetch the count of unassigned users
        if(auth()->user()->hasRole('Asset Manager')) {
            $vendors = Vendor::all();
        }

 return view('dashboard', compact('officesStaffCount','roles','admins','assetManagers','executives','users','staff','unroledUsers' , 'unasignedStaff', 'pendingProblems', 'pendingMaintenances','totalAssets','vendors','offices','users'));
    }
}
