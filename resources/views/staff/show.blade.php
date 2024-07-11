<h1>Staff Member Details</h1>

<p>Name: {{ $staff->name }}</p>
<p>Email: {{ $staff->email }}</p>
<p>Office: {{ $staff->office->name ?? 'N/A' }}</p> <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">Edit</a>

@if (Auth::user()->hasRole('admin') || Auth::user()->id === $staff->id) <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display: inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?')">Delete</button>
</form>
@endif
