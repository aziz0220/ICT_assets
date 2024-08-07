<x-layout :sectionName="__('Assets')" :pageName="__('Create')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (auth()->user()->hasRole('Staff'))
                {{ __('Request New Asset') }}
            @else
                {{ __('Create Asset') }}
            @endif
        </h2>
    </x-slot>
<form method="post" action="/assets">
    @csrf
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            @if (auth()->user()->hasRole('Staff'))
                <h2 class="text-base font-semibold leading-7 text-gray-900">Request New Asset</h2>
            @else
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create An Asset</h2>
            @endif

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="asset_name" class="block text-sm font-medium leading-6 text-gray-900">Asset Name</label>
                    <div class="mt-2">
                        <input type="text" name="asset_name" id="asset_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="purchased_date" class="block text-sm font-medium leading-6 text-gray-900">Purchased Date</label>
                    <div class="mt-2">
                        <input type="date" name="purchased_date" id="purchased_date" autocomplete="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="end_of_life" class="block text-sm font-medium leading-6 text-gray-900">End of Life</label>
                    <div class="mt-2">
                        <input id="end_of_life" name="end_of_life" type="date" autocomplete="end_of_life" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="warrant" class="block text-sm font-medium leading-6 text-gray-900">Warrant</label>
                    <div class="mt-2">
                        <input id="warrant" name="warrant" type="text" autocomplete="warrant-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="col-span-full">
                    <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                    <div class="mt-2">
                        <input type="number" name="quantity" id="quantity" autocomplete="quantity" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="vendor" class="block text-sm font-medium leading-6 text-gray-900">Vendor</label>
                    <div class="mt-2">
                        <select name="vendor_id" id="vendor" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Vendor</option>
                            @foreach ($vendors as $vendorId => $vendorName)
                                <option value="{{ $vendorId }}">{{ $vendorName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                    <div class="mt-2">
                        <select name="category_id" id="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Category</option>
                            @foreach ($categories as $categoryId => $category_name)
                                <option value="{{ $categoryId }}">{{ $category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                    <div class="mt-2">
                        <select name="status_id" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Status</option>
                            @foreach ($statuses as $statusId => $status_name)
                                <option value="{{ $statusId }}">{{ $status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="standard" class="block text-sm font-medium leading-6 text-gray-900">Standard</label>
                    <div class="mt-2">
                        <select name="standard_id" id="standard" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Standard</option>
                            @foreach ($standards as $standardId => $item_name)
                                <option value="{{ $standardId }}">{{ $item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        @if (auth()->user()->hasRole('Staff'))
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send Request</button>
        @else
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
        @endif
  </div>
</form>
</x-layout>
