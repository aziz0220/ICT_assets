<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{

    public function index(Request $request, $id = null)
    {



        $assets = \App\Models\Asset::with('vendor','LIKE','%'.$request->search.'%')->simplePaginate(10);
        return view('assets.index1', [
            'assets' => $assets
        ]);

        $assets = Asset::where('vendor', 'LIKE', '%'.$request->search.'%')
            ->orWhere('serial_no', 'LIKE', '%' .$request->search. '%')
            ->orWhere('assigned_to', 'LIKE', '%' .$request->search. '%')
            ->orWhere('location', 'LIKE', '%' .$request->search. '%')
            ->paginate(50);
        return view('assets.index',compact('assets','created_by','id',));
    }

//    public function department(Request $request, $id)
//    {
//
//
//        $assets = Asset::where('department_id', $id)->where(function($query) use($request) {
//            $query->where('asset_no', 'LIKE', '%'.$request->search.'%')
//                ->orWhere('serial_no', 'LIKE', '%' .$request->search. '%')
//                ->orWhere('assigned_to', 'LIKE', '%' .$request->search. '%')
//                ->orWhere('location', 'LIKE', '%' .$request->search. '%');
//        })->paginate(1000);
//
//
//        return view('asset.index', compact('assets','depart','id','devices'));
//
//    }
//
//    public function device(Request $request, $id)
//    {
//        $devices = Device::all();
//        $depart = Department::all();
//
//        $assets = Asset::where('device_id', $id)->where(function($query) use($request) {
//            $query->where('asset_no', 'LIKE', '%'.$request->search.'%')
//                ->orWhere('serial_no', 'LIKE', '%' .$request->search. '%')
//                ->orWhere('assigned_to', 'LIKE', '%' .$request->search. '%')
//                ->orWhere('location', 'LIKE', '%' .$request->search. '%');
//        })->paginate(1000);
//
//
//        return view('asset.index', compact('assets','devices','id','depart'));
//
//    }

    public function downloadPdf()
    {

        $url = explode('/', url()->current());
        $id = end($url);

        $assets = Asset::where('department_id', $id)->get();
        view()->share('users-pdf',$assets);
        $pdf = PDF::loadView('pdffile.assetpdf', ['assets' => $assets]);

        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::pluck('vendor_name','id');


        return view('assets.create', compact('vendors'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vendor_id' => 'required|integer',
        ]);
        Asset::create([
            'asset_name' => $request->asset_name,
            'purchased_date' => $request->purchased_date,
            'end_of_life' => $request->end_of_life,
            'warrant' => $request->warrant,
            'quantity' =>$request->quantity,
            'vendor_id' => $request->vendor_id,
            'created_by' => fake()->numberBetween(1, 100),
//            'created_by' => Auth::User()->id,
        ]);
        return redirect()->route('asset.index')
            ->with('success','Asset Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        return view('assets.show',compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset) // Route binding using implicit route model binding
    {
        // Fetch the asset based on the route parameter
        // $asset = Asset::findOrFail($assetId); // Alternative approach

        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        $asset->update([
            'asset_name' => $request->asset_name,
            'purchased_date' => $request->purchased_date,
            'end_of_life' => $request->end_of_life,
            'warrant' => $request->warrant,
            'quantity' =>$request->quantity,
            'vendor_id' => $request->vendor_id,
        ]);

        return redirect()->route('asset.index')
            ->with('success','Data Aset Telah Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->back()->with('success','Asset Deleted Successfully.');
    }

    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportAsset, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportAssets(Request $request){
        return Excel::download(new ExportAsset, 'assets.xlsx');
    }

}
