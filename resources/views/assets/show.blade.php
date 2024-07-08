<x-layout>
    <x-slot name="heading">
        Asset
    </x-slot>

    <h2 class="font-bold text-2xl">{{$asset['asset_name']}}</h2>
    <p>
        This asset was purchased on ${{$asset['purchased_date']}}.
    </p>
</x-layout>
