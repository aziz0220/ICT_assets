@props(['assets'])

<div id="registered" class="tab-content">
    @role('Staff|Asset Manager')
    @if($assets->isNotEmpty())
        <div class="rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <x-table-bar :class="'assets'" ></x-table-bar>
                <table class="min-w-full divide-y divide-gray-200 bg-white text-sm table table-striped table-hover">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">
                            <label for="SelectAll" class="sr-only">Select All</label>
                            <input type="checkbox" id="SelectAll" class="rounded border-gray-300 size-5" onclick="toggleSelectAll()" />
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Name</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Purchased Date</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">End of Life</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Vendor</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Category</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Status</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Standard</th>
                        @role('Asset Manager')
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Staff</th>
                        <th class="whitespace-nowrap px-4 py-2 text-gray-900">Office</th>
                        @endrole
                        <th class="px-4 py-2 text-gray-900">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($assets as $asset)
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2">
                                <label class="sr-only" for="Row {{$asset->id}}">Row {{$asset->id}}</label>
                                <input type="checkbox" class="rounded border-gray-300 size-5 class-checkbox" id="Row {{$asset->id}}" value="{{$asset->id}}" />
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$asset->asset_name}}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $asset->purchased_date }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $asset->end_of_life }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($asset->vendor)
                                    {{ $asset->vendor->vendor_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($asset->category)
                                    {{ $asset->category->category_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($asset->status)
                                    {{ $asset->status->status_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($asset->standard)
                                    {{ $asset->standard->item_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            @role('Asset Manager')
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($asset->staff_id)
                                    {{ $asset->staff->user->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($asset->office_id)
                                    {{ $asset->office->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            @endrole
                            <td class="px-4 py-2 text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <x-action-button title="Show" route="assets.show" icon="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" :attribute="$asset->id" />
                                    @can('Request-Asset-Change')
                                        <x-action-button :title="'Edit'" :route="'assets.edit'" :icon="'M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z'" :attribute="$asset->id" />
                                    @endcan
                                    @can('Update-Asset-Details')
                                        <x-action-button :title="'Update Asset Details'" :route="'assets.edit'" :icon="'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99'" :attribute="$asset->id" />
                                    @endcan
                                    @can('Assign-Asset-To-Staff')
                                        <x-action-button :title="'Assign To Staff'" :route="'assets.staff'" :icon="'M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5'" :attribute="$asset->id" />
                                    @endcan
                                    @can('Remove-Registered-Asset')
                                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                                title="Delete Asset"
                                                type="submit"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <x-table-pagination :table="$assets" :firstPage="$assets->onFirstPage()" :previous="$assets->appends(['per_page' => request('per_page')])->previousPageUrl()" :pages="$assets->links()->elements" :current="$assets->currentPage()" :more="$assets->hasMorePages()" :next="$assets->appends(['per_page' => request('per_page')])->nextPageUrl()" />
        </div>
    @endif
    @endrole
</div>
