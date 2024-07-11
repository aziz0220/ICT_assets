<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetCategory;
use Illuminate\Support\Facades\Auth; // For retrieving currently logged-in user
use Illuminate\Support\Facades\Validator; // For validation

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the asset categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetCategories = AssetCategory::latest()->paginate(10); // Paginate results (10 per page)
        return view('assetCategories.index', compact('assetCategories'));
    }

    /**
     * Show the form for creating a new asset category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assetCategories.create');
    }

    /**
     * Store a newly created asset category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:asset_categories,category_name', // Unique validation
        ]);

        if ($validator->fails()) {
            return redirect()->route('asset-category.create')
                ->withErrors($validator)
                ->withInput();
        }

        $assetCategory = AssetCategory::create([
            'category_name' => $request->category_name,
            'created_by' => Auth::user()->id, // Set created_by to logged-in user
        ]);

        return redirect()->route('asset-category.index')
            ->with('success', 'Asset Category created successfully!');
    }

    /**
     * Display the specified asset category.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $assetCategory = AssetCategory::findOrFail($id);
        return view('assetCategories.show', compact('assetCategory'));
    }

    /**
     * Show the form for editing the specified asset category.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $assetCategory = AssetCategory::findOrFail($id);
        return view('assetCategories.edit', compact('assetCategory'));
    }

    /**
     * Update the specified asset category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:asset_categories,category_name,'.$id, // Unique validation excluding self
        ]);

        if ($validator->fails()) {
            return redirect()->route('asset-category.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $assetCategory = AssetCategory::findOrFail($id);
        $assetCategory->update($request->all());

        return redirect()->route('asset-category.index')
            ->with('success', 'Asset Category updated successfully!');
    }

    /**
     * Remove the specified asset category from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $assetCategory = AssetCategory::findOrFail($id);
        $assetCategory->delete();

        return redirect()->route('asset-category.index')
            ->with('success', 'Asset Category deleted successfully!');
    }
}

