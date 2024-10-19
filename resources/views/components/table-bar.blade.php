@props(['class'])
<div class="flex space-x-4 h-14 items-center bg-white/50">
    <form id="bulk-action-form" method="POST" action="{{ route($class . '.bulk-action') }}">
        @csrf
        <input type="hidden" name="selected_items" id="selected_items">
        <input type="hidden" name="action" id="action">
        <div class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
            @can(['approve_new_asset',
                'approve_edit_asset',
                'approve_maintenance',
                'approve_problem'])
                <button
                    type="button"
                    class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                    title="Approve Request"
                    onclick="setActionAndSubmit('approve')"
                    disabled
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            @endcan
            @can('Register-New-Asset')
            <button
                type="button"
                class="h-full inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                title="Register"
                onclick="setActionAndSubmit('register')"
                disabled
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                </svg>
            </button>
            @endcan
            <button
                type="button"
                class="h-full p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                title="Delete"
                onclick="setActionAndSubmit('delete')"
                disabled
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </div>
    </form>

    <form id="pagination-form" method="GET" action="{{ route($class . '.index') }}">
        {{--<label for="pagination-number" class="mr-2">Items per page</label>--}}
        <div class="overflow-hidden rounded-full border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <select title="Items per page" class="rounded-full border" id="pagination-number" name="per_page" onchange="document.getElementById('pagination-form').submit()">
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
        </div>
    </form>
    @role('System Admin')
    <div class=" inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900" style="margin-left: auto">
        <a
            type="button"
            class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
            title="Create new {{$class}}"
            hx-get="{{ route('offices.create') }}"
        hx-target="#office-table-body"
        hx-swap="afterbegin"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        </a>

    </div>
    @endrole

{{--    @role('System Admin')--}}
{{--    <div class=" inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900" style="margin-left: auto">--}}
{{--        <a--}}
{{--            type="button"--}}
{{--            class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"--}}
{{--            title="Create new {{$class}}"--}}
{{--            href="{{ route($class . '.create') }}"--}}
{{--        >--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />--}}
{{--            </svg>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    @endrole--}}
</div>
<script>
    function toggleSelectAll() {
        const selectAllCheckbox = document.getElementById('SelectAll');
        const checkboxes = document.querySelectorAll('.class-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        toggleBulkActionButtons();
    }

    function toggleBulkActionButtons() {
        const checkboxes = document.querySelectorAll('.class-checkbox');
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        const buttons = document.querySelectorAll('#bulk-action-form button');
        buttons.forEach(button => {
            button.disabled = !anyChecked;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.class-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleBulkActionButtons);
        });
    });

    function setActionAndSubmit(action) {
        document.getElementById('action').value = action;
        const selectedItems = Array.from(document.querySelectorAll('.class-checkbox:checked')).map(cb => cb.value);
        document.getElementById('selected_items').value = selectedItems.join(',');
        document.getElementById('bulk-action-form').submit();
    }
</script>
