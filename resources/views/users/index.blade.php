<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                    <div class="float-end">
                        <a class="btn btn-success" href="{{ route('user.create') }}"> Create New User</a>
                    </div>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success my-2">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-secondary text-dark">{{ $v }}</label>
                        @endforeach
                    @else
                        <label class="badge badge-secondary text-2xl">No Role</label>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a><br>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
