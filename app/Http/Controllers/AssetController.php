<?php

    namespace App\Http\Controllers;

    use App\Models\Asset;
    use App\Models\AssetCategory;
    use App\Models\AssetStandard;
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
            $this->middleware(['role:Staff|Asset Manager|Executive Manager'], [['index', 'show']]);
    //        $this->middleware(['permission:Request-New-Asset'], ['create']);
    //        $this->middleware(['permission:Register-New-Asset'], ['create', 'store']);
    //        $this->middleware(['permission:Request-Asset-Change'], ['edit']);
    //        $this->middleware(['permission:Update-Asset-details'], ['edit', 'update']);
    //        $this->middleware(['permission:Remove-Registered-Asset'], ['destroy']);
        }

        public function index(Request $request, $id = null)
        {
            $assets = Asset::with('vendor','category','status','standard')->where('is_registered','=','1')->latest()->paginate(50);
            $requests = Asset::with('vendor','category','status','standard')->where('is_registered','=','0')->latest()->paginate(50);
            return view('assets.index', compact('assets','requests'));
        }


        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $vendors = Vendor::pluck('vendor_name','id');
            $categories = AssetCategory::pluck('category_name','id');
            $statuses = AssetStatus::pluck('status_name', 'id');
            $standards = AssetStandard::pluck('item_name','id');
            return view('assets.create', compact('vendors','categories','statuses','standards'));
        }



        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $asset=Asset::create([
                'asset_name' => $request->asset_name,
                'purchased_date' => $request->purchased_date,
                'end_of_life' => $request->end_of_life,
                'warrant' => $request->warrant,
                'quantity' =>$request->quantity,
                'vendor_id' => $request->vendor_id,
                'category_id' => $request->category_id,
                'standard_id' => $request->standard_id,
                'status_id' => $request->status_id,
                'created_by' => Auth::User()->id,
                'is_registered' => auth()->user()->hasRole('Asset Manager')

            ]);
            return redirect()->route('assets.index')
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
            $vendors = Vendor::pluck('vendor_name','id');
            $categories = AssetCategory::pluck('category_name','id');
            $statuses = AssetStatus::pluck('status_name', 'id');
            $standards = AssetStandard::pluck('item_name','id');

            return view('assets.edit', compact('asset','vendors','categories','statuses','standards'));
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

            $validatedData = $request->validate([
                'asset_name' => 'required|string|max:255',
            ]);

            $asset->is_registered = auth()->user()->hasRole('Asset Manager');

            $asset->update($validatedData);
            return redirect()->route('assets.index')
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



        public function downloadPdf()
        {
            $url = explode('/', url()->current());
            $id = end($url);

            $assets = Asset::where('department_id', $id)->get();
            view()->share('users-pdf',$assets);
            $pdf = PDF::loadView('pdffile.assetpdf', ['assets' => $assets]);

            return $pdf->stream();
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
















        // Additional Asset functionalities

        public function requestAssetChange()
        {
            // Implement logic for staff to request asset change
            // This might involve a form, interaction with the Asset model, etc.
            return view('staff.requestAssetChange'); // Assuming a request asset change view
        }

        public function reportAssetProblem()
        {
            // Implement logic for staff to report asset problem
            // This might involve a form, interaction with the Asset model, etc.
            return view('staff.reportAssetProblem'); // Assuming a report asset problem view
        }

        public function requestAssetMaintainance()
        {

            return view('staff.requestAssetMaintainance'); // Assuming a request asset maintenance view
        }

        public function requestNewAsset()
        {
            // Implement logic for staff to request new asset
            // This might involve a form, interaction with the Asset model, etc.
            return view('staff.requestNewAsset'); // Assuming a request new asset view
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

        public function manageAssetVendor(Asset $asset, Vendor $newVendor)    {
            $asset->save();
            return $asset;
        }

        public function assignAssetToStaff()    {
        }

        public function generateCustomReport(){
        }
    }
