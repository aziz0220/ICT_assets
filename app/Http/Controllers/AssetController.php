<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetStatus;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vtiful\Kernel\Excel;

class AssetController extends Controller
{

    function __construct()
    {
//        'Request-Asset-Problem',
//        'Request-Asset-Maintainance',
//        'Manage-Asset-Standards',
//        'Manage-Asset-Vendor',
//        'Manage-Asset-Categories',
//        'Manage-Asset-Status',
//        $this->middleware(['permission:Register-New-Asset|asset-edit|Remove-Registered-Asset|Request-New-Asset|Request-Asset-Change|Request-Asset-Problem|Request-Asset-Maintainance'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:Request-New-Asset'], ['only' => ['create']]);
        $this->middleware(['permission:Register-New-Asset'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Request-Asset-Change'], ['only' => ['edit']]);
        $this->middleware(['permission:Update-Asset-details'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Remove-Registered-Asset'], ['only' => ['destroy']]);
    }

    public function index(Request $request, $id = null)
    {
        $assets = Asset::with('vendor')->latest()->paginate(50);
        return view('assets.index', compact('assets'));


//        $assets = \App\Models\Asset::with('vendor','LIKE','%'.$request->search.'%')->simplePaginate(10);
//        return view('assets.index1', [
//            'assets' => $assets
//        ]);
//
//        $assets = Asset::where('vendor', 'LIKE', '%'.$request->search.'%')
//            ->orWhere('serial_no', 'LIKE', '%' .$request->search. '%')
//            ->orWhere('assigned_to', 'LIKE', '%' .$request->search. '%')
//            ->orWhere('location', 'LIKE', '%' .$request->search. '%')
//            ->paginate(50);
//        return view('assets.index',compact('assets','created_by','id',));
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
        $asset->validate([
            'asset_name' => $request->asset_name,
            'purchased_date' => $request->purchased_date,
            'end_of_life' => $request->end_of_life,
            'warrant' => $request->warrant,
            'quantity' =>$request->quantity,
            'vendor_id' => $request->vendor_id,
        ]);

        $asset->update($request->all());

        return redirect()->route('asset.index')
            ->with('success','Asset updated successfully.');
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

























    public function registerNewAsset(array $data)
    {

        $asset = Asset::create([
            'asset_name' => $data['asset_name'],
            'purchased_date' => $data['purchased_date'],
            'end_of_life' => $data['end_of_life'],
            'category_id' => $data['category_id'],
            'standard_id' => $data['standard_id'],
            'status_id' => $data['status_id'],
            'vendor_id' => $data['vendor_id'],
        ]);

        return $asset;
    }

    public function updateAssetDetails(Asset $asset, array $data)
    {
        // Validate data (omitted for brevity)

        $asset->update($data);

        return $asset;
    }

    public function removeRegisteredAsset(Asset $asset)
    {
        // Handle asset removal logic (e.g., soft delete, permanent delete)
        $asset->delete();
        return true; // Or appropriate success/failure response
    }

    public function manageAssetStatus(Asset $asset, string $newStatus)
    {
        $status = AssetStatus::where('status_name', $newStatus)->first();

        if (!$status) {
            throw new \Exception("Invalid asset status: $newStatus");
        }

        $asset->status()->associate($status);
        $asset->save();

        return $asset;
    }

    public function manageAssetStandard(Asset $asset, string $newStandard)
    {
        $status = AssetStatus::where('status_name', $newStandard)->first();
        if (!$status) {
            throw new \Exception("Invalid asset standard: $newStandard");
        }
        $asset->status()->associate($status);
        $asset->save();
        return $asset;
    }

    public function manageAssetCategories(Asset $asset, string $newStandard)
    {
        $status = AssetStatus::where('status_name', $newStandard)->first();
        if (!$status) {
            throw new \Exception("Invalid asset standard: $newStandard");
        }
        $asset->status()->associate($status);
        $asset->save();
        return $asset;
    }

    public function manageAssetVendor(Asset $asset, Vendor $newVendor)
    {
        $asset->save();
        return $asset;
    }

    public function assignAssetToStaff()
    {
    }

    public function generateCustomReport(){


    }
}
