@extends('layouts.app')

@section('content')
    <h1>Edit Vendor</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
        @csrf
        @method('PUT')  <div class="form-group">
            <label for="vendor_name">Vendor Name</label>
            <input type="text" name="vendor_name" id="vendor_name" class="form-control" value="{{ old('vendor_name', $vendor->vendor_name) }}" required>
        </div>

        <div class="form-group">
            <label for="vendor_shortname">Short Name (Max 50 characters)</label>
            <input type="text" name="vendor_shortname" id="vendor_shortname" class="form-control" value="{{ old('vendor_shortname', $vendor->vendor_shortname) }}" maxlength="50" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Vendor</button>
    </form>

@endsection
