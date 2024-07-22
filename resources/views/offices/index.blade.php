<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Offices') }}
        </h2>
    </x-slot>
    <div class="container">
        <a href="{{ route('offices.create') }}" class="btn btn-primary">Add Office</a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Head Office</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($offices as $office)
                <tr>
                    <td>{{ $office->name }}</td>
                    <td>{{ $office->location }}</td>
                    <td>{{ $office->headOffice->user->name ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('offices.destroy', $office->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('offices.show', $office->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('offices.edit', $office->id) }}">Edit</a>
                            <a href="{{ route('offices.assignStaffForm', $office->id) }}" class="btn btn-primary">Assign Staff</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $offices->links() !!}
    </div>
</x-app-layout>
