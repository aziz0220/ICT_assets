<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Staff Office') }}
        </h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('staff.updateOffice', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="office_id">Select Office:</label>
                <select name="office_id" id="office_id" class="form-control">
                    <option value="">None</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}" {{ $staff->office_id == $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-app-layout>
