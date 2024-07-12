<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assets') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>
                    <div class="float-end">
                        @can('Request-New-Asset')
                            <a class="btn btn-success" href="asset/create"> Request New Asset</a>
                        @endcan
                        @can('Register-New-Asset')
                            <a class="btn btn-success" href="asset/create"> Register New Asset</a>
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
                    <form action="{{ route('asset.destroy',$asset->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('asset.show',$asset->id) }}">Show</a>
                        @can('Request-Asset-Change')
                            <a class="btn btn-primary" href="{{ route('asset.edit',$asset->id) }}">Request Change</a>
                        @endcan
                        @can('Update-Asset-Details')
                            <a class="btn btn-primary" href="{{ route('asset.edit',$asset->id) }}">Update Asset Details</a>
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

</x-app-layout>>
