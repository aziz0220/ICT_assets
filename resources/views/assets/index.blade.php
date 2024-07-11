@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Assets
                    <div class="float-end">
                        @can('Register-New-Asset')
                            <a class="btn btn-success" href="{{ route('asset.create') }}"> Create New Asset</a>
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
                    <form action="{{ route('asset.destroy',$asset->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('asset.show',$asset->id) }}">Show</a>
                        @can('Update-Asset-details')
                            <a class="btn btn-primary" href="{{ route('asset.edit',$asset->id) }}">Edit</a>
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

@endsection
