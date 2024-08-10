<x-layout :sectionName="__('Edit')" :pageName="__('Standard')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Asset Standard') }}
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

    <form action="{{ route('assetStandards.update', $assetStandard->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" id="item_name" class="form-control" value="{{ old('item_name', $assetStandard->item_name) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $assetStandard->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-layout>>
