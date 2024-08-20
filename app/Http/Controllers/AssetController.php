<?php

    namespace App\Http\Controllers;

    use App\Models\Asset;
    use App\Models\AssetCategory;
    use App\Models\AssetChange;
    use App\Models\AssetStandard;
    use App\Models\AssetStatus;
    use App\Models\Staff;
    use App\Models\User;
    use App\Models\Vendor;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Vtiful\Kernel\Excel;

    class AssetController extends Controller
    {

        function __construct()
        {
            $this->middleware(['role:Staff|Asset Manager|Executive Manager|Head Office'], [['index', 'show']]);
    //        $this->middleware(['permission:Request-New-Asset'], ['create']);
    //        $this->middleware(['permission:Register-New-Asset'], ['create', 'store']);
    //        $this->middleware(['permission:Request-Asset-Change'], ['edit']);
    //        $this->middleware(['permission:Update-Asset-details'], ['edit', 'update']);
    //        $this->middleware(['permission:Remove-Registered-Asset'], ['destroy']);
        }

        public function index(Request $request, $id = null)
        {
            $user = Auth::user();
            $assigned = collect();
            if($user->hasRole('Staff')){
//                $assigned = Asset::with('vendor','category','status','standard','staff','staff.user','office')->where('is_registered','=','1')->where('head_approval','=','1')->where('office_id','=',$user->staff->office->id)->latest()->paginate(10, ['*'], 'assigned_page');
                $assigned = Asset::with('vendor','category','status','standard','staff','staff.user','office')->where('is_registered','=','1')->where('head_approval','=','1')->where('office_id','=',$user->staff->office->id)->where('staff_id','=',$user->staff->id)->latest()->paginate(10, ['*'], 'assigned_page');

            }
            $perPage = $request->input('per_page', 10); // Default to 10 items per page
            $assets = Asset::with('vendor', 'category', 'status', 'standard', 'staff', 'staff.user', 'office')
                ->where('is_registered', '=', '1')
                ->where('head_approval', '=', '1')
                ->latest()
                ->paginate($perPage, ['*'], 'registered_page');
            $approvedReq = Asset::with('vendor','category','status','standard')->where('is_registered','=','0')->where('head_approval','=','1')->latest()->paginate(10, ['*'], 'approved_page');
            $requests = Asset::with('vendor','category','status','standard')->where('is_registered','=','0')->where('head_approval','=','0')->latest()->paginate(10, ['*'], 'requested_page');
            $approvedChange = AssetChange::with('vendor','category','status','standard')->where('head_approval','=','1')->latest()->paginate(10, ['*'], 'approved_change_page');
            $changes = AssetChange::with('vendor','category','status','standard')->where('head_approval','=','0')->latest()->paginate(10, ['*'], 'requested_change_page');
            return view('assets.index', compact('assets','requests', 'changes','approvedReq','approvedChange','assigned'));
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

        public function approveNewRequest($id)
        {
            $asset = Asset::findOrFail($id);
            $user = Auth::user();
            if ($user->staff->office->head_id == $user->staff->id) {
                if($asset->is_registered == 0 && $asset->head_approval == 0) {
                    $asset->head_approval = 1;
                    $asset->save();
                    return redirect()->route('assets.index')->with('success', 'Asset approved successfully.');
                }
                else{
                    return redirect()->route('assets.index')->with('error', 'Cannot Perform Approval to this Asset.');
                }
            }
            return redirect()->route('assets.index')->with('error', 'You are not authorized to approve this asset.');
        }

        public function approveEditRequest($id)
        {
            $asset = AssetChange::findOrFail($id);
            $user = Auth::user();
            if ($user->staff->office->head_id == $user->staff->id) {
                if($asset->is_registered == 0 && $asset->head_approval == 0) {
                    $asset->head_approval = 1;
                    $asset->save();
                    return redirect()->route('assets.index')->with('success', 'Asset approved successfully.');
                }
                else{
                    return redirect()->route('assets.index')->with('error', 'Cannot Perform Approval to this Asset.');
                }
            }
            return redirect()->route('assets.index')->with('error', 'You are not authorized to approve this asset.');
        }


        public function disapproveNewRequest($id)
        {
            $asset = Asset::findOrFail($id);
            $user = Auth::user();
            if ($user->staff->office->head_id == $user->staff->id) {
                if($asset->is_registered == 0 && $asset->head_approval == 1) {
                    $asset->head_approval = 0;
                    $asset->save();
                    return redirect()->route('assets.index')->with('success', 'Asset disapproved successfully.');
                }
                else{
                    return redirect()->route('assets.index')->with('error', 'Cannot Perform Disapproval to this Asset.');
                }
            }
            return redirect()->route('assets.index')->with('error', 'You are not authorized to disapprove this asset.');
        }


        public function disapproveEditRequest($id)
        {
            $asset = AssetChange::findOrFail($id);
            $user = Auth::user();
            if ($user->staff->office->head_id == $user->staff->id) {
                if($asset->is_registered == 0 && $asset->head_approval == 1) {
                    $asset->head_approval = 0;
                    $asset->save();
                    return redirect()->route('assets.index')->with('success', 'Asset disapproved successfully.');
                }
                else{
                    return redirect()->route('assets.index')->with('error', 'Cannot Perform Disapproval to this Asset.');
                }
            }
            return redirect()->route('assets.index')->with('error', 'You are not authorized to disapprove this asset.');
        }

        public function assignAssetToStaff()    {
            $assets = Asset::where('is_registered', 1)->where('head_approval', 1)->get();
            $staff = Staff::with('user')->where('is_blocked', 0)->get();
            return view('assets.assign', compact('assets', 'staff'));
        }


        public function assignAsset(Request $request)
        {
            $request->validate([
                'asset_id' => 'required|exists:assets,id',
                'staff_id' => 'required|exists:staff,id',
            ]);

            $asset = Asset::findOrFail($request->asset_id);
            $staff = Staff::findOrFail($request->staff_id);

            $asset->staff_id = $staff->id;
            $asset->save();

            return redirect()->route('assets.index')->with('success', 'Asset assigned to staff successfully.');
        }


        public function assignStaff($id){
            $asset = Asset::findOrFail($id);
            $staff = Staff::with('user')->where('is_blocked','=','0')->get();
            return view('assets.staff',compact('asset','staff'));
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






        public function bulkAction(Request $request)
        {
            $action = $request->input('action');
            $assetIds = explode(',', $request->input('selected_assets'));

            switch ($action) {
                case 'edit':
                    // Handle bulk edit
                    foreach ($assetIds as $id) {
                        // Edit logic
                    }
                    break;
                case 'approve':
                    // Handle bulk approve
                    foreach ($assetIds as $id) {
                        $asset = Asset::approveNewRequest($id);
                    }
                    break;
                case 'disapprove':
                    // Handle bulk disapprove
                    foreach ($assetIds as $id) {
                        $asset = Asset::disapproveNewRequest($id);
                    }
                    break;
                case 'assign':
                    // Handle bulk assign
                    foreach ($assetIds as $id) {
                        $asset = Asset::assignAsset($id);
                    }
                    break;
                case 'delete':
                    foreach ($assetIds as $id) {
                        Asset::destroy($id);
                    }
                    break;
                default:
                    return back()->with('error', 'Invalid action selected');
            }

            return back()->with('success', 'Bulk action performed successfully');
        }










        // Additional Asset functionalities


        public function generateCustomReport(){
        }
    }
