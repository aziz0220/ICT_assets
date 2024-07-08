<h1>Assets</h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Asset Name</th>
        <th>Purchased Date</th>
        <th>End of Life</th>
        <th>Vendor</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($assets as $asset)
        <tr>
            <td>{{ $asset->asset_name }}</td>
            <td>{{ $asset->purchased_date }}</td>
            <td>{{ $asset->end_of_life }}</td>
            <td>
                @if ($asset->vendor)
                    {{ $asset->vendor->vendor_name }}
                @else
                    N/A
                @endif
            </td>
{{--            <td>--}}
{{--                <a href="{{ route('assets.edit', $asset->id) }}">Edit</a>--}}
{{--                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display: inline-block">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit">Delete</button>--}}
{{--                </form>--}}
{{--            </td>--}}
        </tr>
    @empty
        <tr>
            <td colspan="5">No assets found.</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $assets->links() }}

