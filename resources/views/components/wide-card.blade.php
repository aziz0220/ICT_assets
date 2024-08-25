@props(['asset'])

<x-panel class="flex gap-x-6">
    <div>
        <x-staff-logo :staff="$asset->vendor" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="{{ route('vendor.show', $asset->vendor->id) }}" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $asset->vendor->vendor_name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="{{ route('assets.show', $asset->id)   }}" target="_blank">
                {{ $asset->asset_name }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto">{{ $asset->end_of_life }}</p>
    </div>

    <div>
        <x-tag :asset="$asset->category->category_name" size="base" />
        <x-tag :asset="$asset->status->status_name" size="base" />
        <x-tag :asset="$asset->standard->item_name" size="base" />
        <x-tag :asset="$asset->vendor->vendor_name" size="base" />
    </div>
</x-panel>
