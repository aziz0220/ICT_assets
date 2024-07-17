<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Staff Member Details') }}
    </h2>
</x-slot>

<p>Name: {{ $staff->user->name }}</p>
<p>Email: {{ $staff->user->email }}</p>
<p>Office: {{ $staff->office->name ?? 'N/A' }}</p> <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">Edit</a>

@if (Auth::user()->hasRole('admin') || Auth::user()->id === $staff->id) <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display: inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?')">Delete</button>
</form>
@endif
</x-app-layout>
