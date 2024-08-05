<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bulk Update Assets') }}
        </h2>
    </x-slot>

    <form action="{{ route('assets.bulk-update-save') }}" method="POST">
        @csrf
        <input type="hidden" name="ids" value="{{ implode(',', $assets->pluck('id')->toArray()) }}">
        <!-- Add form fields for updating asset details -->
        @foreach ($assets as $asset)
            <div>
                <label for="asset_name_{{ $asset->id }}">Asset Name:</label>
                <input type="text" name="asset_name[{{ $asset->id }}]" id="asset_name_{{ $asset->id }}" value="{{ $asset->asset_name }}">
            </div>
            <!-- Add other fields as needed -->
        @endforeach
        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Save Changes</button>
    </form>
</x-layout>
