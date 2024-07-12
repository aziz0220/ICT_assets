<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset') }}
        </h2>
    </x-slot>


    <h2 class="font-bold text-2xl">{{$asset['asset_name']}}</h2>
    <p>
        This asset was purchased on {{$asset['purchased_date']}}.
    </p>
</x-app-layout>>
