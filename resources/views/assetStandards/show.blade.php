<x-layout :sectionName="__('Show')" :pageName="__('Standard')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset Standard Details') }}
        </h2>
    </x-slot>

    <p><strong>Item Name:</strong> {{ $assetStandard->item_name }}</p>
    <p><strong>Description:</strong> {{ $assetStandard->description }}</p>

    <a href="{{ route('asset-standard.edit', $assetStandard->id) }}" class="btn btn-primary">Edit</a>

    @can('delete asset_standards')
        <form action="{{ route('asset-standard.destroy', $assetStandard->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
</x-layout>
