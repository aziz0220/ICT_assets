<!-- resources/views/offices/partials/edit_office_row.blade.php -->
<tr id="office-row-{{ $office->id }}">
    <form action="{{ route('offices.update', $office->id) }}" method="POST">
        @csrf
        @method('PUT')
        <td>
            <input type="text" name="name" value="{{ $office->name }}" class="form-control" required>
        </td>
        <td>
            <input type="text" name="location" value="{{ $office->location }}" class="form-control" required>
        </td>
        <td>
            <select name="head_office_id" class="form-control">
                <option value="">Select Head</option>
                @foreach($staff as $member)
                    <option value="{{ $member->id }}" {{ $office->head_id == $member->id ? 'selected' : '' }}>
                        {{ $member->user->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('offices.index') }}" class="btn btn-secondary">Cancel</a>
        </td>
    </form>
</tr>
