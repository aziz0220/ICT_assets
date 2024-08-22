<x-layout :sectionName="__('Manage')" :pageName="__('Users')">

    @if ($message = Session::get('success'))
        <div class="alert alert-success my-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
        <x-table-bar :class="'user'" ></x-table-bar>
        <table class="table table-bordered table-hover table-striped min-w-full">
        <thead>
            <tr>
                <th class="inset-y-0 start-0 bg-white px-4 py-2">
                    <label for="SelectAll" class="sr-only">Select All</label>
                    <input type="checkbox" id="SelectAll" class="size-5 rounded border-gray-300" onclick="toggleSelectAll()" />
                </th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Name</th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Role</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
        </thead>
        @foreach ($data as $key => $user)
        <tbody class="bg-white">
            <tr class="odd:bg-gray-50">
                <td class="inset-y-0 start-0 bg-white px-4 py-2 w-10">
                    <label class="sr-only" for="Row {{$user->id}}">Row {{$user->id}}</label>
                    <input class="size-5 rounded border-gray-300 class-checkbox" type="checkbox" id="Row {{$user->id}}" value="{{$user->id}}" />
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
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
