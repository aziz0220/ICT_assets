<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assets') }}
        </h2>
    </x-slot>
@role('Staff')
    <h1> Registered Assets </h1>
@endrole
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>
                    <div class="float-end">
                        @can('Request-New-Asset')
                            <a class="btn btn-success" href="assets/create"> Request New Asset</a>
                        @endcan
                        @can('Register-New-Asset')
                            <a class="btn btn-success" href="assets/create"> Register New Asset</a>
                        @endcan
                    </div>
                </h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th>purchased date</th>
            <th>end of life</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Status</th>
            <th>Standard</th>
        </tr>
        @foreach ($assets as $asset)
            <tr>
                <td>{{$asset->asset_name}}</td>
                <td>{{ $asset->purchased_date  }}</td>
                <td>{{ $asset->end_of_life }}</td>
                <td>
                    @if ($asset->vendor)
                        {{ $asset->vendor->vendor_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                @if ($asset->category)
                    {{ $asset->category->category_name }}
                @else
                    N/A
                @endif
                </td>
                <td>
                    @if ($asset->status)
                        {{ $asset->status->status_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($asset->standard)
                        {{ $asset->standard->item_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <form action="{{ route('assets.destroy',$asset->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('assets.show',$asset->id) }}">Show</a>
                        @can('Request-Asset-Change')
                            <a class="btn btn-primary" href="{{ route('assets.edit',$asset->id) }}">Request Change</a>
                        @endcan
{{--                        @can('Request-Asset-Maintenance')--}}
{{--                            <a class="btn btn-primary" href="{{ route('assets.maintenance',$asset->id) }}">Request Maintenance</a>--}}
{{--                        @endcan--}}
{{--                        @can('Request-Asset-Problem')--}}
{{--                            <a class="btn btn-primary" href="{{ route('assets.problem',$asset->id) }}">Report Problem</a>--}}
{{--                        @endcan--}}
                        @can('Update-Asset-Details')
                            <a class="btn btn-primary" href="{{ route('assets.edit',$asset->id) }}">Update Asset Details</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('Remove-Registered-Asset')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    @role('Asset Manager')

    <h1>Requested Assets</h1>
    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th>purchased date</th>
            <th>end of life</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Status</th>
            <th>Standard</th>
        </tr>
        @foreach ($requests as $req)
            <tr>
                <td>{{$req->asset_name}}</td>
                <td>{{ $req->purchased_date  }}</td>
                <td>{{ $req->end_of_life }}</td>
                <td>
                    @if ($req->vendor)
                        {{ $req->vendor->vendor_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->category)
                        {{ $req->category->category_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->status)
                        {{ $req->status->status_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->standard)
                        {{ $req->standard->item_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <form action="{{ route('assets.update', $req->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group hidden" >
                            <label for="asset_name">Item Name:</label>
                            <input type="text" name="asset_name" id="asset_name" class="form-control" value="{{ $req->asset_name }}" required>
                        </div>
                        <form action="{{ route('assets.approve', $req->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
                        <button type="submit" class="btn btn-primary">Register Asset</button>

                    </form>
                    <form action="{{ route('assets.destroy',$req->id) }}" method="POST">

                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    @endrole


@role('Staff')
    <h1> Requested Assets </h1>


    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th>purchased date</th>
            <th>end of life</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Status</th>
            <th>Standard</th>
        </tr>
        @foreach ($requests as $req)
            <tr>
                <td>{{$req->asset_name}}</td>
                <td>{{ $req->purchased_date  }}</td>
                <td>{{ $req->end_of_life }}</td>
                <td>
                    @if ($req->vendor)
                        {{ $req->vendor->vendor_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->category)
                        {{ $req->category->category_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->status)
                        {{ $req->status->status_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->standard)
                        {{ $req->standard->item_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('assets.show',$req->id) }}">Show</a>
                    <form action="{{ route('assets.destroy',$req->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel Request</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>








    <h1> Requested Changes </h1>


    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th>purchased date</th>
            <th>end of life</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Status</th>
            <th>Standard</th>
        </tr>
        @foreach ($changes as $req)
            <tr>
                <td>{{$req->asset_name}}</td>
                <td>{{ $req->purchased_date  }}</td>
                <td>{{ $req->end_of_life }}</td>
                <td>
                    @if ($req->vendor)
                        {{ $req->vendor->vendor_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->category)
                        {{ $req->category->category_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->status)
                        {{ $req->status->status_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($req->standard)
                        {{ $req->standard->item_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('assets.show',$req->asset_id) }}">Original</a>
                    <a class="btn btn-info" href="{{ route('assetchanges.edit', $req) }}" > Edit Request</a>
                    <form action="{{ route('assetchanges.destroy',$req->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel Request</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endrole
</x-app-layout>>
