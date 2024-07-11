@extends('layouts.app')

@section('content')
    <h1>Asset Standards</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($assetStandards as $assetStandard)
            <tr>
                <td>{{ $assetStandard->item_name }}</td>
                <td>{{ $assetStandard->description }}</td>
                <td>
                    <a href="{{ route('asset-standard.show', $assetStandard->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('asset-standard.edit', $assetStandard->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('asset-standard.destroy', $assetStandard->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('asset-standard.create') }}" class="btn btn-primary">Create New Asset Standard</a>
@endsection
