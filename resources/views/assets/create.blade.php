
<form method="post" action="/asset">
    @csrf
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Create An Asset</h2>

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

            </div>
        </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
