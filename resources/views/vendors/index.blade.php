@extends('layouts.app')

@section('content')
    <h1>Vendors</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Vendor Name</th>
            <th>Short Name</th>
            <th>Created By</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($vendors as $vendor)
            <tr>
                <td>{{ $vendor->vendor_name }}</td>
                <td>{{ $vendor->vendor_shortname }}</td>
                <td>{{ $vendor->created_by }}</td> <td>
                    <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    @can('delete vendors')  <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vendor?')">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('vendor.create') }}" class="btn btn-primary">Create New Vendor</a>

@endsection
