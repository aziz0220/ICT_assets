<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff List') }}
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
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Office</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($staff as $staffMember)
        <tr>
            <th scope="row">{{ $staffMember->id }}</th>
            <td>{{ $staffMember->name }}</td>
            <td>{{ $staffMember->email }}</td>
            <td>{{ $staffMember->office->name ?? 'N/A' }}</td> <td>
                <a href="{{ route('staff.show', $staffMember->id) }}" class="btn btn-primary">View</a>
                <a href="{{ route('staff.edit', $staffMember->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('staff.destroy', $staffMember->id) }}" method="POST" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="{{ route('staff.create') }}" class="btn btn-success">Add Staff Member</a>
</x-app-layout>
