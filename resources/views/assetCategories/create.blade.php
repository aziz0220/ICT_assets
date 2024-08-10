<x-layout :sectionName="__('Create')" :pageName="__('Categories')">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asset-category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ old('category_name') }}" required>
        </div>
        <div>
            <label for="logo">Category Logo</label>
            <input type="file" name="logo" id="logo">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

</x-layout>>
