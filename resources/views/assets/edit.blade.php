<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (auth()->user()->hasRole('Staff'))
                {{ __('Request Asset Change') }}
            @else
                {{ __('Edit Asset') }}
            @endif
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @role('Staff')
    <form action="{{ route('assetchanges.store', $asset->id) }}" method="POST">
        @csrf
        @method('POST')
        @endrole
    @role('Asset Manager')
    <form action="{{ route('assets.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT')
        @endrole
        <div class="form-group">
            <label for="asset_name">Item Name:</label>
            <input type="text" name="asset_name" id="asset_name" class="form-control" value="{{ $asset->asset_name }}" required>
        </div>
        <div class="form-group">
            <label for="purchased_date">Purchased Date:</label>
            <input type="date" name="purchased_date" id="purchased_date" class="form-control" value="{{ $asset->purchased_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_of_life">End Of Life:</label>
            <input type="date" name="end_of_life" id="end_of_life" class="form-control" value="{{ $asset->purchased_date }}" required>
        </div>
        <div class="form-group">
            <label for="warrant">Warrant:</label>
            <input type="text" name="warrant" id="warrant" class="form-control" value="{{ $asset->warrant }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $asset->quantity }}" required>
        </div>
        <div class="sm:col-span-2 sm:col-start-1">
            <label for="vendor" class="block text-sm font-medium leading-6 text-gray-900">Vendor</label>
            <div class="mt-2">
                <select name="vendor_id" id="vendor" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @foreach ($vendors as $vendorId => $vendorName)
                        <option value="{{ $vendorId }}" @if ($vendorId === $asset->vendor_id)
                            selected>
                            @endif>{{ $vendorName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="sm:col-span-2 sm:col-start-1">
            <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
            <div class="mt-2">
                <select name="category_id" id="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @foreach ($categories as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}" @if ($categoryId === $asset->category_id)
                            selected>
                            @endif>{{ $categoryName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="sm:col-span-2 sm:col-start-1">
            <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
            <div class="mt-2">
                <select name="status_id" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @foreach ($statuses as $statusId => $statusName)
                        <option value="{{ $statusId }}" @if ($statusId === $asset->status_id)
                            selected>
                            @endif>{{ $statusName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="sm:col-span-2 sm:col-start-1">
            <label for="standard" class="block text-sm font-medium leading-6 text-gray-900">Standard</label>
            <div class="mt-2">
                <select name="standard_id" id="standard" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @foreach ($standards as $standardId => $standardName)
                        <option value="{{ $standardId }}" @if ($standardId === $asset->standard_id)
                            selected>
                            @endif>{{ $standardName }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        @role('Staff')
                <button type="submit" class="btn btn-primary">Send Request</button>
        @endrole
        @role('Asset Manager')
        <button type="submit" class="btn btn-primary">Update</button>
        @endrole
    </form>
</x-app-layout>
