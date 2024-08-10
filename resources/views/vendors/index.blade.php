<x-layout :sectionName="__('Manage')" :pageName="__('Vendors')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendors') }}
        </h2>
    </x-slot>


    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Vendor Name</th>
            <th>Short Name</th>
            <th>Created By</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($vendors as $vendor)
            <tr>
                <td>{{ $vendor->vendor_name }}</td>
                <td>{{ $vendor->vendor_shortname }}</td>
                <td>{{ $vendor->creator->name }}</td> <td>
                    <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-sm btn-info">View</a>
                    @can('Manage-Asset-Vendor')
                        <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vendor?')">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('vendor.create') }}" class="btn btn-primary">Create New Vendor</a>
</x-layout>>
