<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetStandard;
use App\Models\AssetStatus;
use App\Models\Office;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('q');
//        $type = $request->input('type');

//        $results = collect();
        $users = collect();
        $assets = collect();
        $categories = collect();
        $standards = collect();
        $statuses = collect();
        $vendors = collect();
        $offices = collect();

        if(auth()->user()->hasRole('Asset Manager')) {
            $assets = Asset::query()
                ->with(['vendor', 'category', 'status', 'standard', 'staff', 'staff.user', 'office'])
                ->where('asset_name', 'LIKE', '%' . $query . '%')
                ->get();
            $categories = AssetCategory::query()
                ->where('category_name', 'LIKE', '%' . $query . '%')
                ->get();
            $standards = AssetStandard::query()
                ->where('item_name', 'LIKE', '%' . $query . '%')
                ->get();
            $statuses = AssetStatus::query()
                ->where('status_name', 'LIKE', '%' . $query . '%')
                ->get();
            $vendors = Vendor::query()->with('creator')
                ->where('vendor_name', 'LIKE', '%' . $query . '%')
                ->get();
        }
        elseif (auth()->user()->hasRole('Staff|Executive Manager|Head Office')) {
            $assets = Asset::query()
                ->with(['vendor', 'category', 'status', 'standard', 'staff', 'staff.user', 'office'])
                ->where('asset_name', 'LIKE', '%' . $query . '%')
                ->get();
        }
        elseif (auth()->user()->hasRole('System Admin')) {
            $users = User::query()
                ->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->get();
            $offices = Office::query()
                ->where('name', 'LIKE', '%' . $query . '%')
                ->get();
        }

        return view('results', compact('assets', 'categories', 'standards', 'statuses', 'vendors', 'users', 'offices'));
    }
}
