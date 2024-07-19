<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Office') }}
        </h2>
    </x-slot>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('offices.update', $office->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $office->name }}">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" class="form-control" value="{{ $office->location }}">
            </div>
            <div class="form-group">
                <label for="head_id">Head Office:</label>
                <select name="head_id" class="form-control">
                    <option value="">None</option>
                    @foreach ($staff as $staffMember)
                        <option value="{{ $staffMember->id }}" {{ $staffMember->id == $office->head_id ? 'selected' : '' }}>
                            {{ $staffMember->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
