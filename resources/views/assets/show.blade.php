<x-layout :sectionName="__('View')" :pageName="__('Asset')">

    <div class="flow-root rounded-lg border border-gray-100 top-0 shadow-sm dark:border-gray-700">
        <dl class="-my-3 divide-y divide-gray-100 text-sm dark:divide-gray-700">
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Asset Name</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->asset_name }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Purchased Date</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->purchased_date }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">End of Life</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->end_of_life }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Vendor</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->vendor->vendor_name ?? 'N/A' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Category</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->category->category_name ?? 'N/A' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Status</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->status->status_name ?? 'N/A' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Standard</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->standard->item_name ?? 'N/A' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Quantity</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->quantity }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Warranty</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->warrant }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Registered</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->is_registered ? 'Yes' : 'No' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Created By</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $asset->creator->name }}</dd>
            </div>
        </dl>
    </div>
</x-layout>
