<x-layout :sectionName="__('Assign')" :pageName="__('Asset')">
    <div class="container mt-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assets.assign') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="asset_id">Select Asset:</label>
                <select name="asset_id" id="asset_id" class="form-control">
                    <option value="">-- Select Asset --</option>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="staff_id">Select Staff:</label>
                <select name="staff_id" id="staff_id" class="form-control">
                    <option value="">-- Select Staff --</option>
                    @foreach($staff as $staffMember)
                        <option value="{{ $staffMember->id }}">{{ $staffMember->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Assign Asset</button>
        </form>
    </div>
</x-layout>
