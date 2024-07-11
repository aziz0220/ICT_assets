@extends('layouts.app')

@section('content')
    <h1>Asset Standard Details</h1>

    <p><strong>Item Name:</strong> {{ $assetStandard->item_name }}</p>
    <p><strong>Description:</strong> {{ $assetStandard->description }}</p>

    <a href="{{ route('asset-standard.edit', $assetStandard->id) }}" class="btn btn-primary">Edit</a>

    @can('delete asset_standards')
        <form action="{{ route('asset-standard.destroy', $assetStandard->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
@endsection
