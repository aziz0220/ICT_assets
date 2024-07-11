<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Vendor') }}
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

    <form action="{{ route('vendor.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="vendor_name">Vendor Name</label>
            <input type="text" name="vendor_name" id="vendor_name" class="form-control" value="{{ old('vendor_name') }}" required>
        </div>

        <div class="form-group">
            <label for="vendor_shortname">Short Name (Max 50 characters)</label>
            <input type="text" name="vendor_shortname" id="vendor_shortname" class="form-control" value="{{ old('vendor_shortname') }}" maxlength="50" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Vendor</button>
    </form>
</x-app-layout>>
