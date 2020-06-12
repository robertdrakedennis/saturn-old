@extends('layouts.master')
@section('title', 'Users')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light">All Users</h1>
                    <form method="POST" class="py-2" action="{{ action('Dashboard\UsersController@create') }}">
                        @csrf
                        @method('POST')
                        <label for="steamidInput" class="text-light">Enter Steamid</label>
                        <div class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-alternative rounded" name="steamid" id="steamidInput" value="{{ old('steamid') }}">
                                <span>
                                    <button type="submit" class="btn btn-success mx-2">Add User</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Users</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Name</th>
                                <th scope="col">SteamID</th>
                                <th scope="col">Role</th>
                                <th scope="col">Front Role</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><img src="{{ $user->avatar }}" style="border-radius: 50%; height: auto; width: 1.5rem;"/> </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->steamid }}</td>
                                    <td>
                                        {{$user->getRoleNames()->first()}}
                                    </td>
                                    <td>{{ $user->team->name ?? 'None' }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-primary">Profile</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{ $users->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
