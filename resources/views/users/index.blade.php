<x-layout :sectionName="__('Manage')" :pageName="__('Users')">
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb mb-4">--}}
{{--            <div class="pull-left">--}}
{{--                    <div class="float-end">--}}
{{--                        <a class="btn btn-success" href="{{ route('user.create') }}"> Create New User</a>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success my-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <div class="flex space-x-4 h-14" >
                <form id="bulk-action-form" method="POST" action="{{ route('users.bulk-action') }}">
                    @csrf
                    <input type="hidden" name="selected_users" id="selected_users">
                    <input type="hidden" name="action" id="action">
                    <div class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <button
                            type="button"
                            class="h-full inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
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
                <form id="pagination-form" method="GET" action="{{ route('user.index') }}" class="">
{{--                    <label for="pagination-number" class="mr-2">Items per page</label>--}}
                    <select title="Items per page" class="w-full h-full text-gray-600 bg-white border rounded-lg shadow-sm outline-none appearance-none focus:ring-offset-2 focus:ring-indigo-600 focus:ring-2" id="pagination-number" name="per_page" onchange="document.getElementById('pagination-form').submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
                <div class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <a
                        type="button"
                        class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                        title="Create New User"
                        href="{{ route('user.create') }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                </div>
            </div>
            <script>
                function setActionAndSubmit(action) {
                    document.getElementById('action').value = action;
                    document.getElementById('bulk-action-form').submit();
                }

                function toggleSelectAll() {
                    const selectAllCheckbox = document.getElementById('SelectAll');
                    const checkboxes = document.querySelectorAll('.user-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                    toggleBulkActionButtons();
                }

                function toggleBulkActionButtons() {
                    const checkboxes = document.querySelectorAll('.user-checkbox');
                    const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                    const buttons = document.querySelectorAll('#bulk-action-form button');
                    buttons.forEach(button => {
                        button.disabled = !anyChecked;
                    });
                }

                document.addEventListener('DOMContentLoaded', () => {
                    const checkboxes = document.querySelectorAll('.user-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', toggleBulkActionButtons);
                    });
                });
            </script>
        <table class="table table-bordered table-hover table-striped min-w-full">
        <thead>
            <tr>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Name</th>
{{--                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">--}}
{{--                Email</th>--}}
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Role</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
        </thead>
        @foreach ($data as $key => $user)
        <tbody class="bg-white">
            <tr>
                <td  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10">
                            <img class="w-10 h-10 rounded-full"
                                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                 alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium leading-5 text-gray-900">{{ $user->name }}
                            </div>
                            <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    @if(!empty($user->getRoleNames()->first()))
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">{{ $user->getRoleNames()->first() }}</span>
                    @else
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">No Role</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-center space-x-2">
                        <x-action-button :title="'Show'" :route="'user.show'" :icon="'M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z'" :attribute="$user->id" />
                        <x-action-button :title="'Edit'" :route="'user.edit'" :icon="'M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z'" :attribute="$user->id" />
                        @unless($user->getRoleNames()->first()=='System Admin')

                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    title="Delete Account"
                                    class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                    onclick="return confirm('Are you sure you want to delete this member?')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                        @endunless
                    </div>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
            <x-table-pagination :firstPage="$data->onFirstPage()" :previous="$data->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$data->links()->elements" :current="$data->currentPage()" :more="$data->hasMorePages()" :next="$data->appends(['per_page' => request('per_page')])->nextPageUrl()"></x-table-pagination>
    </div>
    </div>
</x-layout>
