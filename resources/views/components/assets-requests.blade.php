@props(['requests','changes'])
<div id="requests" class="tab-content" style="display:none;">
    @role('Asset Manager')
    @if($requests->isNotEmpty())
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
        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
            <ol class="flex justify-end gap-1 text-xs font-medium">
                <!-- Previous Page Link -->
                @if ($assets->onFirstPage())
                    <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</span></li>
                @else
                    <li><a href="{{ $assets->appends(['per_page' => request('per_page')])->previousPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</a></li>
                @endif

                <!-- Pagination Elements -->
                @foreach ($assets->appends(['per_page' => request('per_page')])->elements as $element)
                    <!-- "Three Dots" Separator -->
                    @if (is_string($element))
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">{{ $element }}</span></li>
                    @endif

                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $assets->currentPage())
                                <li class="active"><span class="inline-flex size-8 items-center justify-center rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}" class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($assets->hasMorePages())
                    <li><a href="{{ $assets->appends(['per_page' => request('per_page')])->nextPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</a></li>
                @else
                    <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</span></li>
                @endif
            </ol>
        </div>

    @endif

    @if($changes->isNotEmpty())
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
                        <form action="{{ route('assets.update', $req->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group hidden" >
                                <label for="asset_name">Item Name:</label>
                                <input type="text" name="asset_name" id="asset_name" class="form-control" value="{{ $req->asset_name }}" required>
                            </div>
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
        {{ $changes->links() }}
    @endif
    @endrole

    @role('Staff|Head Office')
    @if($requests->isNotEmpty())
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
                        @can('approve_new_asset')
                            <form action="{{ route('assets.approve', $req->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                        @endcan
                        <form action="{{ route('assets.destroy',$req->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancel Request</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $requests->links() }}
    @endif


    @if($changes->isNotEmpty())
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
                            @can('approve_edit_asset')
                                <form action="{{ route('assets.approveChange', $req->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </form>
                            @endcan

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancel Request</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $changes->links() }}
    @endif
    @endrole
</div>
