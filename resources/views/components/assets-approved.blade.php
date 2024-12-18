@props(['approvedReq','approvedChange'])
<div id="approved" class="tab-content" style="display:none;">
    @role('Staff|Head Office')
    @if($approvedReq->isNotEmpty())
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <div class="flex space-x-4">
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
                    @foreach ($approvedReq as $req)
                        <tr class="odd:bg-gray-50">
                            <td class=" inset-y-0 start-0 bg-white px-4 py-2">
                                <label class="sr-only" for="Row {{$req->id}}">Row {{$req->id}}</label>
                                <input class="size-5 rounded border-gray-300 asset-checkbox" type="checkbox" id="Row {{$req->id}}" value="{{$req->id}}" />
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
                                    <a
                                        class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                        title="Show"
                                        href="{{ route('assets.show', $req->id) }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    @can('approve_edit_asset')
                                        <form action="{{ route('assets.disapprove', $req->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" title="Disapprove" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
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
                    @endforeach
                </table>
            </div>
            <x-table-pagination :table:="$approvedReq" :firstPage="$approvedReq->onFirstPage()" :previous="$approvedReq->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$approvedReq->links()->elements" :current="$approvedReq->currentPage()" :more="$approvedReq->hasMorePages()" :next="$approvedReq->appends(['per_page' => request('per_page')])->nextPageUrl()"></x-table-pagination>
        </div>
    @endif


    @if($approvedChange->isNotEmpty())
        <h1> Approved Changes </h1>
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <div class="flex space-x-4">
                    <form id="bulk-action-form" method="POST" action="{{ route('assets.bulk-action') }}">
                        @csrf
                        <input type="hidden" name="selected_assets" id="selected_assets">
                        <input type="hidden" name="action" id="action">
                        <div class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <button
                                type="button"
                                class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                                title="Cancel Request"
                                onclick="setActionAndSubmit('delete')"
                                disabled
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <form id="pagination-form" method="GET" action="{{ route('assets.index') }}" class="inline-block ml-4">
                        <label for="pagination-number" class="mr-2">Items per page:</label>
                        <select id="pagination-number" name="per_page" onchange="document.getElementById('pagination-form').submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
                <script>
                    function setActionAndSubmit(action) {
                        document.getElementById('action').value = action;
                        document.getElementById('bulk-action-form').submit();
                    }

                    function toggleSelectAll() {
                        const selectAllCheckbox = document.getElementById('SelectAll');
                        const checkboxes = document.querySelectorAll('.asset-checkbox');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = selectAllCheckbox.checked;
                        });
                        toggleBulkActionButtons();
                    }

                    function toggleBulkActionButtons() {
                        const checkboxes = document.querySelectorAll('.asset-checkbox');
                        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                        const buttons = document.querySelectorAll('#bulk-action-form button');
                        buttons.forEach(button => {
                            button.disabled = !anyChecked;
                        });
                    }
                    document.addEventListener('DOMContentLoaded', () => {
                        const checkboxes = document.querySelectorAll('.asset-checkbox');
                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', toggleBulkActionButtons);
                        });
                    });
                </script>
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
            @foreach ($approvedChange as $req)

                <tr class="odd:bg-gray-50">
                    <td class=" inset-y-0 start-0 bg-white px-4 py-2">
                        <label class="sr-only" for="Row {{$req->id}}">Row {{$req->id}}</label>
                        <input class="size-5 rounded border-gray-300 asset-checkbox" type="checkbox" id="Row {{$req->id}}" value="{{$req->id}}" />
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
                        @can('approve_edit_asset')
                            <form action="{{ route('assets.disapprove', $req->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" title="Disapprove" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
            </div>
            <x-table-pagination :table:="$approvedChange" :firstPage="$approvedChange->onFirstPage()" :previous="$approvedChange->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$approvedChange->links()->elements" :current="$approvedChange->currentPage()" :more="$approvedChange->hasMorePages()" :next="$approvedChange->appends(['per_page' => request('per_page')])->nextPageUrl()"></x-table-pagination>
    @endif
    @endrole
        </div>
</div>
