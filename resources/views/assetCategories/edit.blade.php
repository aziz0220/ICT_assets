<x-app-layout>

@section('content')
        <x-slot name="header">
    <h1>Edit Asset Category</h1>
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

    <form action="{{ route('asset-category.update', $assetCategory->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ old('category_name', $assetCategory->category_name) }}" required>
        </div>
    </form>
</x-app-layout>