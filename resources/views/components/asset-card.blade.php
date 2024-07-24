@props(['asset'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $asset->creator->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-500 text-xl font-bold transition-colors duration-300">
            <a href="{{ route('assets.show', $asset->id) }}" target="_blank">
                {{ $asset->asset_name }}
            </a>
        </h3>
        <p class="text-sm mt-4">{{ $asset->end_of_life }}</p>
    </div>
    <div class="flex justify-between items-center mt-auto">
        <div>
            <x-tag :asset="$asset->category->category_name" size="small" />
            <x-tag :asset="$asset->status->status_name" size="small" />
            <x-tag :asset="$asset->standard->item_name" size="small" />
            <x-tag :asset="$asset->vendor->vendor_name" size="small" />
        </div>
        <x-vendor-logo :vendor="$asset->vendor->vendor_name" width="25" />
    </div>
</x-panel>
