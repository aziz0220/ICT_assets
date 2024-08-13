<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(){
        $assets = Asset::with('vendor','category','status','standard','staff','staff.user','office','creator')->where('is_registered','=','1')->where('head_approval','=','1')->latest()->paginate(9);
        $vendors = Vendor::all();
        if(Auth::user()){
            return redirect()->route('dashboard.index');
        }
        return view('welcome', compact('assets','vendors' ));
    }
}
