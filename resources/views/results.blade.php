<x-layout>
    <x-page-heading>Results</x-page-heading>

    <div class="space-y-6">
        @foreach($assets as $asset)
            <x-wide-card :$asset />
        @endforeach
    </div>
</x-layout>
