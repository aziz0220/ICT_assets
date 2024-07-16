<?php

namespace App\Http\Controllers;

use App\Models\Biography;
use App\Models\Staff;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index()
    {
        $biographies = Staff::all();

        return response()->json($biographies);
    }

    public function show($id)
    {
        $biography = Staff::find($id);
        if ($biography) {
            return response()->json($biography);
        } else {
            return response()->json(['message' => 'Biography not found'], 404);
        }
    }

    public function detail($id){

        $details = Staff::findOrFail($id)->user;
        if ($details) {
            return response()->json($details);
        } else {
            return response()->json(['message' => 'Biography not found'], 404);
        }
    }
//
//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|max:255',
//            'bio' => 'required',
//        ]);
//
//        $biography = Staff::create($validatedData);
//        return response()->json($biography, 201);
//    }
//
//    public function update(Request $request, $id)
//    {
//        $biography = Staff::find($id);
//        if ($biography) {
//            $validatedData = $request->validate([
//                'name' => 'sometimes|required|max:255',
//                'bio' => 'sometimes|required',
//            ]);
//
//            $biography->update($validatedData);
//            return response()->json($biography);
//        } else {
//            return response()->json(['message' => 'Biography not found'], 404);
//        }
//    }
//
//    public function destroy($id)
//    {
//        $biography = Staff::find($id);
//        if ($biography) {
//            $biography->delete();
//            return response()->json(['message' => 'Biography deleted']);
//        } else {
//            return response()->json(['message' => 'Biography not found'], 404);
//        }
//    }
}

