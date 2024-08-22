<x-layout :sectionName="__('Manage')" :pageName="__('Staff')">

    @if ($message = Session::get('success'))
        <div class="alert alert-success my-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <x-table-bar :class="'staff'"></x-table-bar>
            <table class="table table-bordered table-hover table-striped min-w-full">
                <thead>
                <tr>
                    <th class="inset-y-0 start-0 bg-white px-4 py-2 w-10">
                        <label for="SelectAll" class="sr-only">Select All</label>
                        <input type="checkbox" id="SelectAll" class="size-5 rounded border-gray-300" onclick="toggleSelectAll()" />
                    </th>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        User
                    </th>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Office
                    </th>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Status
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach ($staff as $staffMember)
                    <tr class="odd:bg-gray-50">
                        <td class="inset-y-0 start-0 bg-white px-4 py-2">
                            <label class="sr-only" for="Row {{ $staffMember->id }}">Row {{ $staffMember->id }}</label>
                            <input class="size-5 rounded border-gray-300 class-checkbox" type="checkbox" id="Row {{ $staffMember->id }}" value="{{ $staffMember->id }}" />
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $staffMember->user->name }}</div>
                                    <div class="text-sm leading-5 text-gray-500">{{ $staffMember->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $staffMember->office->name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        @if(!$staffMember->is_blocked)
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                        @else
                            <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Blocked</span>
                        @endif
                        </td>
                        <td>
                            <div class="flex items-center justify-center space-x-2">
                                <x-action-button :title="'Show'" :route="'staff.show'" :icon="'M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z'" :attribute="$staffMember->id" />
                                <x-action-button :title="'Edit'" :route="'staff.edit'" :icon="'M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z'" :attribute="$staffMember->id" />
                                @role('System Admin')
                                @if(!$staffMember->is_blocked)
                                <x-action-button :title="'Block'" :route="'staff.block'" :icon="'M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636'" :attribute="$staffMember->id" />
                                @else
                                <x-action-button :title="'Unlock'" :route="'staff.unblock'" :icon="'M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z'" :attribute="$staffMember->id" />
                                @endif
                                @endrole
                                    <form action="{{ route('staff.destroy', $staffMember->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Delete Staff Member"
                                            class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                            onclick="return confirm('Are you sure you want to delete this staff member?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <x-table-pagination :firstPage="$staff->onFirstPage()" :previous="$staff->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$staff->links()->elements" :current="$staff->currentPage()" :more="$staff->hasMorePages()" :next="$staff->appends(['per_page' => request('per_page')])->nextPageUrl()"></x-table-pagination>
        </div>
    </div>
</x-layout>
