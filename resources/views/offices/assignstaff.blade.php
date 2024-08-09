<x-layout :sectionName="__('Assign')" :pageName="__('Staff')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assign Staff to Office') }}
        </h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('offices.assignStaff', $office->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="staff_id">Select Staff Member:</label>
                <select name="staff_id" id="staff_id" class="form-control">
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign</button>
        </form>
    </div>
</x-layout>
