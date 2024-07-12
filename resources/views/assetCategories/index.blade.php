<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset categories') }}
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
            <th>Item Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($assetCategories as $assetCategory)
            <tr>
                <td>{{ $assetCategory->category_name }}</td>
                <td>
                    <a href="{{ route('asset-category.show', $assetCategory->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('asset-category.edit', $assetCategory->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('asset-category.destroy', $assetCategory->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('asset-category.create') }}" class="btn btn-primary">Create New Asset category</a>
</x-app-layout>>
