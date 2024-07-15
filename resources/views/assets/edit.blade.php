<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Asset') }}
        </h2>
    </x-slot>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assets.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="asset_name">Item Name:</label>
            <input type="text" name="asset_name" id="asset_name" class="form-control" value="{{ old('asset_name', $asset->asset_name) }}" required>
        </div>
        @role('Staff')
                <button type="submit" class="btn btn-primary">Send Request</button>
        @endrole
        @role('Asset Manager')
        <button type="submit" class="btn btn-primary">Update</button>
        @endrole
    </form>
</x-app-layout>
