<x-layout :sectionName="__('Manage')" :pageName="__('Assets')">
    <script>
        function toggleSelectAll() {
            var checkboxes = document.querySelectorAll('.asset-checkbox');
            var selectAll = document.getElementById('SelectAll');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            });
            collectSelectedIds();
        }

        document.querySelectorAll('.asset-checkbox').forEach((checkbox) => {
            checkbox.addEventListener('change', collectSelectedIds);
        });

        function collectSelectedIds() {
            var selected = [];
            document.querySelectorAll('.asset-checkbox:checked').forEach((checkbox) => {
                selected.push(checkbox.value);
            });
            document.getElementById('selected_assets').value = selected.join(',');
        }
    </script>
    <x-tabs></x-tabs>
    <x-alerts.alert></x-alerts.alert>

    <x-assets-actions></x-assets-actions>


    <x-assets-registered :assets="$assets"></x-assets-registered>



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
    <div id="assigned" class="tab-content" style="display:none;">
        @role('Staff')
        @if($assigned->isNotEmpty())
            <h1> Assigned Assets </h1>


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
                @foreach ($assigned as $req)
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
                            <a class="btn btn-info" href="{{ route('assets.show', $req->id) }}">Show</a>
                            <!-- Asset Problem Form -->
                            @can('Request-Asset-Problem')
                                <form action="{{ route('asset.problem.store', $req->id) }}" method="POST">
                                    @csrf
                                    <textarea name="description" class="form-control" placeholder="Describe the problem" required></textarea>
                                    <button type="submit" class="btn btn-danger mt-2">Report Problem</button>
                                </form>
                            @endcan

                            <!-- Asset Maintenance Form -->
                            @can('Request-Asset-Maintenance')
                                <form action="{{ route('asset.maintenance.store', $req->id) }}" method="POST">
                                    @csrf
                                    <textarea name="description" class="form-control" placeholder="Describe maintenance needed" required></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Request Maintenance</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $assigned->links() }}
        @endif


        @endrole

    </div>

    <div id="approved" class="tab-content" style="display:none;">
        @role('Staff|Head Office')

        @if($approvedReq->isNotEmpty())
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
                @foreach ($approvedReq as $req)
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
                            @can('approve_edit_asset')
                                <form action="{{ route('assets.disapprove', $req->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Disapprove</button>
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
            {{ $approvedReq->links() }}
        @endif

        @if($approvedChange->isNotEmpty())


            <h1> Approved Changes </h1>


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
                @foreach ($approvedChange as $req)
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
                            @can('approve_edit_asset')
                                <form action="{{ route('assets.disapprove', $req->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Disapprove</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
{{--            {{ $approvedChange->links() }}--}}

            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    @if ($approvedChange->onFirstPage())
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</span></li>
                    @else
                        <li><a href="{{ $approvedChange->previousPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</a></li>
                    @endif

                    <!-- Pagination Elements -->
                    @foreach ($approvedChange->appends(['registered_page' => $approvedChange->currentPage()])->elements as $element)
                        <!-- "Three Dots" Separator -->
                        @if (is_string($element))
                            <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">{{ $element }}</span></li>
                        @endif

                        <!-- Array Of Links -->
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $approvedChange->currentPage())
                                    <li class="active"><span class="inline-flex size-8 items-center justify-center rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}" class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    <!-- Next Page Link -->
                    @if ($approvedChange->hasMorePages())
                        <li><a href="{{ $approvedChange->nextPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</a></li>
                    @else
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</span></li>
                    @endif
                </ol>
            </div>
        @endif
        @endrole

    </div>

</x-layout>
