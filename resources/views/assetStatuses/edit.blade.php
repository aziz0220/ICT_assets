<x-layout :sectionName="__('Edit')" :pageName="__('Status')">
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Asset status') }}
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

    <form action="{{ route('asset-status.update', $assetStatus->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="status_name">Status Name:</label>
            <input type="text" name="status_name" id="status_name" class="form-control" value="{{ old('status_name', $assetStatus->status_name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-layout>
