<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Office Details') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $office->name }}
            </div>
            <div class="card-body">
                <p><strong>Location:</strong> {{ $office->location }}</p>
                <p><strong>Head Office:</strong> {{ $office->headOffice->user->name ?? 'N/A' }}</p>
                @if($office->headOffice)
                    <form action="{{ route('offices.removeHead', $office) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-danger">Remove Head Office</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                {{ __('Staff Members') }}
            </div>
            <div class="card-body">
                @if($staff->isEmpty())
                    <p>No staff members found for this office.</p>
                @else
                    <ul>
                        @foreach($staff as $staffMember)
                            <li>{{ $staffMember->user->name }} ({{ $staffMember->is_blocked ? 'Blocked' : 'Active' }})</li>
                        @endforeach
                    </ul>
                @endif

                @if(!$office->headOffice)
                    <form action="{{ route('offices.setHead', $office) }}" method="POST" class="mt-2">
                        @csrf
                        <div class="form-group">
                            <label for="staff_id">Set Head Office:</label>
                            <select name="staff_id" id="staff_id" class="form-control">
                                @foreach($staff as $staffMember)
                                    <option value="{{ $staffMember->id }}">{{ $staffMember->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Set Head Office</button>
                    </form>
                @endif
            </div>
        </div>

        <a class="btn btn-primary mt-4" href="{{ route('offices.index') }}">Back</a>
    </div>
</x-app-layout>
