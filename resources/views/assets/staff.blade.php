<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assign Asset to Staff') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('assets.assign') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="asset_name" class="col-md-4 col-form-label text-md-right">{{ __('Asset Name') }}</label>

                                <div class="col-md-6">
                                    <input id="asset_name" type="text" class="form-control" name="asset_name" value="{{ $asset->asset_name }}" disabled>
                                    <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staff_id" class="col-md-4 col-form-label text-md-right">{{ __('Assign to Staff') }}</label>

                                <div class="col-md-6">
                                    <select id="staff_id" class="form-control" name="staff_id" required>
                                        <option value="">{{ __('Select Staff') }}</option>
                                        @foreach($staff as $staff_member)
                                            <option value="{{ $staff_member->id }}">{{ $staff_member->user->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('staff_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('staff_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Assign Asset') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
