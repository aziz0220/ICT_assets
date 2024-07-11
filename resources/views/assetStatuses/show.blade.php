<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset Standard Details') }}
        </h2>
    </x-slot>
    <p><strong>Status:</strong> {{ $assetStatus->status_name }}</p>

    <a href="{{ route('asset-status.edit', $assetStatus->id) }}" class="btn btn-primary">Edit</a>

    @can('delete asset_statuses')
        <form action="{{ route('asset-status.destroy', $assetStatus->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
</x-app-layout>>
