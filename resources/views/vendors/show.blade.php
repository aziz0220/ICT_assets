<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendor Details') }}
        </h2>
    </x-slot>


    <p><strong>Vendor Name:</strong> {{ $vendor->vendor_name }}</p>
    <p><strong>Short Name:</strong> {{ $vendor->vendor_shortname }}</p>
    <p><strong>Created By:</strong> {{  $vendor->creator->name  }} </p>

    @can('edit vendors')  <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary">Edit Vendor</a>
    @endcan

    @can('delete vendors')  <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vendor?')">Delete</button>
    </form>
    @endcan
</x-app-layout>>
