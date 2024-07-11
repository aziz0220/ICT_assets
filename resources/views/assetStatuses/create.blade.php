<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Create Asset status') }}
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

    <form action="{{ route('asset-status.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status_name">Status Name:</label>
            <input type="text" name="status_name" id="status_name" class="form-control" value="{{ old('status_name') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</x-app-layout>>
