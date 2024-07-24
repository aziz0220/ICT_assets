<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $assets = Asset::query()
            ->with(['vendor','category','status','standard','staff','staff.user','office'])
            ->where('asset_name','LIKE','%'.\request('q').'%')
            ->get();

        return view('results', ['assets' => $assets]);
    }
}
