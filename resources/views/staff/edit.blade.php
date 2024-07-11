<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Staff Member') }}
        </h2>
    </x-slot>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('staff.update', $staff->id) }}" method="POST">
    @csrf
    @method('PUT')  <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $staff->name) }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $staff->email) }}">
    </div>
    <div class="form-group">
        <label for="office_id">Office</label>
        <select class="form-control" id="office_id" name="office_id">
            @foreach ($offices as $office)
                <option value="{{ $office->id }}"
                        @if ($office->id === $staff->office_id)
                            selected
                    @endif
                >{{ $office->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Staff Member</button>
</form>
</x-app-layout>
