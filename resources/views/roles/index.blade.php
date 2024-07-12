<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role Management') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>
                    <div class="float-end">
                        @can('Manage-Role')
                            <a class="btn btn-success" href="{{ route('role.create') }}"> Create New Role</a>
                        @endcan
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('role.show', $role->id) }}">Show</a>
                        @can('Manage-Role')
                            <a class="btn btn-primary" href="{{ route('role.edit', $role->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('Manage-Role')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $roles->render() !!}
</x-app-layout>>
