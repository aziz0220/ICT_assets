<x-layout>
    <div class="space-y-10">
        <section class="text-center select-none pt-6">
            <h1 class="font-bold text-4xl relative inline-block after:absolute after:bg-gray-200 after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-left after:scale-x-100 hover:after:origin-bottom-right hover:after:scale-x-0 after:transition-transform after:ease-in-out after:duration-300">ICT Register</h1>
{{--            <div class="font-bold text-4xl relative inline-block before:absolute before:bg-sky-600 before:bottom-0 before:left-0 before:h-full before:w-full before:origin-bottom before:scale-y-[0.01] hover:before:scale-y-100 before:transition-transform before:ease-in-out before:duration-500"><span class="relative">Hover over me</span></div>--}}
        </section>

        <section>
            <x-section-heading>Registered Assets</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach($assets as $asset)
                    <x-asset-card :$asset/>
                @endforeach
            </div>
            {{ $assets->links() }}
        </section>
        <section>
            <x-section-heading>Vendors</x-section-heading>

            <div class="mt-6 space-x-1">
                @foreach($vendors as $vendor)
                    <x-tag :asset="$vendor->vendor_name" size="base"/>
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Recent Problems</x-section-heading>

            <div class="mt-6 space-y-6">
                @foreach($assets as $asset)
                    <x-wide-card :$asset />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
