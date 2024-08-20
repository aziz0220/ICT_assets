@props(['assigned'])
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const problemButtons = document.querySelectorAll('.report-problem-button');
        const maintenanceButtons = document.querySelectorAll('.request-maintenance-button');

        problemButtons.forEach(button => {
            button.addEventListener('click', function() {
                const assetId = this.dataset.assetId;
                document.getElementById('problemAssetId').value = assetId;
                $('#reportProblemModal').modal('show');
            });
        });

        maintenanceButtons.forEach(button => {
            button.addEventListener('click', function() {
                const assetId = this.dataset.assetId;
                document.getElementById('maintenanceAssetId').value = assetId;
                $('#requestMaintenanceModal').modal('show');
            });
        });
    });
</script>
<div id="assigned" class="tab-content" style="display:none;">
    @role('Staff')
    @if($assigned->isNotEmpty())
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <div class="flex space-x-4">
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
                    @foreach ($assigned as $req)
                    <tr class="odd:bg-gray-50">
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
                                @can('Request-Asset-Problem')
                                    <a
                                        class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800 report-problem-button"
                                        title="Report Problem"
                                        href="javascript:void(0)"
                                        data-asset-id="{{ $req->id }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>
                                    </a>
{{--                                    <form action="{{ route('asset.problem.store', $req->id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <textarea name="description" class="form-control" placeholder="Describe the problem" required></textarea>--}}
{{--                                        <button type="submit" class="btn btn-danger mt-2">Report Problem</button>--}}
{{--                                    </form>--}}
                                @endcan
                                @can('Request-Asset-Maintenance')
                                    <a
                                        class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800 request-maintenance-button"
                                        title="Request Maintenance"
                                        href="javascript:void(0)"
                                        data-asset-id="{{ $req->id }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                        </svg>
                                    </a>
{{--                                    <form action="{{ route('asset.maintenance.store', $req->id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <textarea name="description" class="form-control" placeholder="Describe maintenance needed" required></textarea>--}}
{{--                                        <button type="submit" class="btn btn-primary mt-2">Request Maintenance</button>--}}
{{--                                    </form>--}}
                                @endcan
                                </div>
                        </td>
                    </tr>
            @endforeach
        </table>
        </div>
            <x-table-pagination :table:="$assigned" :firstPage="$assigned->onFirstPage()" :previous="$assigned->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$assigned->links()->elements" :current="$assigned->currentPage()" :more="$assigned->hasMorePages()" :next="$assigned->appends(['per_page' => request('per_page')])->nextPageUrl()"></x-table-pagination>
        </div>
        <!-- Report Problem Modal -->
        <div class="modal fade" id="reportProblemModal" tabindex="-1" aria-labelledby="reportProblemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportProblemModalLabel">Report Problem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('asset.problem.store', $req->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="asset_id" id="problemAssetId">
                            <div class="form-group">
                                <label for="problemDescription">Description</label>
                                <textarea name="description" id="problemDescription" class="form-control" placeholder="Describe the problem" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Report Problem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Request Maintenance Modal -->
        <div class="modal fade" id="requestMaintenanceModal" tabindex="-1" aria-labelledby="requestMaintenanceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestMaintenanceModalLabel">Request Maintenance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('asset.maintenance.store', $req->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="asset_id" id="maintenanceAssetId">
                            <div class="form-group">
                                <label for="maintenanceDescription">Description</label>
                                <textarea name="description" id="maintenanceDescription" class="form-control" placeholder="Describe maintenance needed" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Request Maintenance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endif

    @endrole


</div>
