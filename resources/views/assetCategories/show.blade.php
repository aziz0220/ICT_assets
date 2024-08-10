<x-layout :sectionName="__('Show')" :pageName="__('Categories')">
    <p><strong>Category Name:</strong> {{ $assetCategory->category_name }}</p>
    <p><strong>Created By:</strong> {{ $assetCategory->created_by }} </p>

    <a href="{{ route('asset-category.edit', $assetCategory->id) }}" class="btn btn-primary">Edit</a>

    @can('delete asset_categories')
        <form action="{{ route('asset-category.destroy', $assetCategory->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
</x-layout>>
