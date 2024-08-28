@props(['requests','changes'])
<div id="requests" class="tab-content" style="display:none;">
    @role('Asset Manager')
    @if($requests->isNotEmpty())
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <x-table-bar :class="'assets'" ></x-table-bar>
                <table class="table table-striped table-hover min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class=" inset-y-0 start-0 bg-white px-4 py-2">
                        <label for="SelectAll" class="sr-only">Select All</label>
                        <input type="checkbox" id="SelectAll" class="size-5 rounded border-gray-300" onclick="toggleSelectAll()" />
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">Name</th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">purchased date</th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">end of life</th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">Vendor</th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">Category</th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">Status</th>
                    <th class="whitespace-nowrap px-4 py-2 text-gray-900">Standard</th>
                    <th class="px-4 py-2 text-gray-900">Actions</th>
                </tr>
                </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach ($requests as $req)
                <tr class="odd:bg-gray-50">
                    <td class=" inset-y-0 start-0 bg-white px-4 py-2">
                        <label class="sr-only" for="Row {{$req->id}}">Row {{$req->id}}</label>
                        <input class="size-5 rounded border-gray-300 class-checkbox" type="checkbox" id="Row {{$req->id}}" value="{{$req->id}}" />
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$req->asset_name}}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $req->purchased_date  }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $req->end_of_life }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->vendor)
                            {{ $req->vendor->vendor_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->category)
                            {{ $req->category->category_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->status)
                            {{ $req->status->status_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->standard)
                            {{ $req->standard->item_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                        <div class="flex items-center space-x-2">
                            <x-action-button title="Show" route="assets.show" icon="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" :attribute="$req->id" />
                            <form action="{{ route('assets.update', $req->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group hidden" >
                                    <label for="asset_name">Item Name:</label>
                                    <input type="text" name="asset_name" id="asset_name" class="form-control" value="{{ $req->asset_name }}" required>
                                </div>
                                <button type="submit" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                        title="Register Asset"
                                        type="submit"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('assets.destroy',$req->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                title="Reject">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            </div>
            <x-table-pagination :firstPage="$requests->onFirstPage()" :previous="$requests->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$requests->links()->elements" :current="$requests->currentPage()" :more="$requests->hasMorePages()" :next="$requests->appends(['per_page' => request('per_page')])->nextPageUrl()"></x-table-pagination>
    </div>
    @endif

    @if($changes->isNotEmpty())
        <x-table-bar :class="'assets'" ></x-table-bar>
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
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <x-table-bar :class="'assets'" ></x-table-bar>
                <table class="table table-striped table-hover min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class=" inset-y-0 start-0 bg-white px-4 py-2">
                    <label for="SelectAll" class="sr-only">Select All</label>
                    <input type="checkbox" id="SelectAll" class="size-5 rounded border-gray-300" onclick="toggleSelectAll()" />
                </th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">Name</th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">purchased date</th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">end of life</th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">Vendor</th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">Category</th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">Status</th>
                <th class="whitespace-nowrap px-4 py-2 text-gray-900">Standard</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach ($requests as $req)
                <tr class="odd:bg-gray-50">
                    <td class=" inset-y-0 start-0 bg-white px-4 py-2">
                        <label class="sr-only" for="Row {{$req->id}}">Row {{$req->id}}</label>
                        <input class="size-5 rounded border-gray-300 class-checkbox" type="checkbox" id="Row {{$req->id}}" value="{{$req->id}}" />
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$req->asset_name}}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $req->purchased_date  }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $req->end_of_life }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->vendor)
                            {{ $req->vendor->vendor_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->category)
                            {{ $req->category->category_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->status)
                            {{ $req->status->status_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        @if ($req->standard)
                            {{ $req->standard->item_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <div class="flex items-center space-x-2">
                            <x-action-button title="Show" route="assets.show" icon="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" :attribute="$req->id" />
                            @can('approve_new_asset')
                                <form action="{{ route('assets.approve', $req->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" title="Approve"  class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                            <form action="{{ route('assets.destroy',$req->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Cancel Request" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
            </div>
            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    @if ($requests->onFirstPage())
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</span></li>
                    @else
                        <li><a href="{{ $requests->previousPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</a></li>
                    @endif

                    <!-- Pagination Elements -->
                    @foreach ($requests->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $requests->currentPage())
                                    <li class="active"><span class="inline-flex size-8 items-center justify-center rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}" class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($requests->hasMorePages())
                        <li><a href="{{ $requests->nextPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</a></li>
                    @else
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</span></li>
                    @endif
                </ol>
            </div>
        </div>
    @endif


    @if($changes->isNotEmpty())
        <h1> Requested Changes </h1>
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <x-table-bar :class="'assets'" ></x-table-bar>
                <table class="table table-striped table-hover min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class=" inset-y-0 start-0 bg-white px-4 py-2">
                                <label for="SelectAll" class="sr-only">Select All</label>
                                <input type="checkbox" id="SelectAll" class="size-5 rounded border-gray-300" onclick="toggleSelectAll()" />
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">Name</th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">purchased date</th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">end of life</th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">Vendor</th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">Category</th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">Status</th>
                            <th class="whitespace-nowrap px-4 py-2 text-gray-900">Standard</th>
                            <th class="px-4 py-2 text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($changes as $req)
                        <tr class="odd:bg-gray-50">
                            <td class=" inset-y-0 start-0 bg-white px-4 py-2">
                                <label class="sr-only" for="Row {{$req->id}}">Row {{$req->id}}</label>
                                <input class="size-5 rounded border-gray-300 class-checkbox" type="checkbox" id="Row {{$req->id}}" value="{{$req->id}}" />
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$req->asset_name}}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $req->purchased_date  }}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $req->end_of_life }}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                @if ($req->vendor)
                                    {{ $req->vendor->vendor_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                @if ($req->category)
                                    {{ $req->category->category_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                @if ($req->status)
                                    {{ $req->status->status_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                @if ($req->standard)
                                    {{ $req->standard->item_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                <a
                                    class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                    title="Original"
                                    href="{{ route('assets.show',$req->asset_id) }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a
                                    class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                    title="Edit Request"
                                    href="{{ route('assetchanges.edit', $req) }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </a>
                                <form action="{{ route('assetchanges.destroy',$req->id) }}" method="POST">
                                    @can('approve_edit_asset')
                                        <form action="{{ route('assets.approveChange', $req->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" title="Approve" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" title="Cancel Request" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
            </div>
            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    @if ($changes->onFirstPage())
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</span></li>
                    @else
                        <li><a href="{{ $changes->previousPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&laquo;</a></li>
                    @endif

                    <!-- Pagination Elements -->
                    @foreach ($changes->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $changes->currentPage())
                                    <li class="active"><span class="inline-flex size-8 items-center justify-center rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}" class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($changes->hasMorePages())
                        <li><a href="{{ $changes->nextPageUrl() }}" class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</a></li>
                    @else
                        <li class="disabled"><span class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">&raquo;</span></li>
                    @endif
                </ol>
            </div>
        </div>
    @endif
    @endrole
</div>
