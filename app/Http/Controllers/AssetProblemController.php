<?php

namespace App\Http\Controllers;

use App\Models\AssetProblem;
use Illuminate\Http\Request;

class AssetProblemController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        AssetProblem::create([
            'asset_id' => $id,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Problem reported successfully.');
    }
}
