<x-app-layout>

{{--@section('content')--}}
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Asset statuses') }}
            </h2>
        </x-slot>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($assetstatuses as $assetstatus)
            <tr>
                <td>{{ $assetstatus->status_name }}</td>
                <td>
                    <a href="{{ route('asset-status.show', $assetstatus->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('asset-status.edit', $assetstatus->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('asset-status.destroy', $assetstatus->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('asset-status.create') }}" class="btn btn-primary">Create New Asset status</a>
{{--@endsection--}}


</x-app-layout>
