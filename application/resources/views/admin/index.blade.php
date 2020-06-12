@extends('layouts.master')
@section('title', 'Home')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid d-flex align-items-center">
            <div class="header-body w-100">
                <div class="col-12">
                    <h1 class="header text-light">Dashboard</h1>
                </div>
                <div class="card-deck">
                    <div class="card my-3" style="-ms-flex-preferred-size: 210px!important;    flex-basis: 210px!important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Links</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $links->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-link"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3" style="-ms-flex-preferred-size: 210px!important;    flex-basis: 210px!important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Features</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $features->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-fire"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3" style="-ms-flex-preferred-size: 210px!important;    flex-basis: 210px!important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Teams</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $teams->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-user-astronaut"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3" style="-ms-flex-preferred-size: 210px!important;    flex-basis: 210px!important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Servers</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $servers->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-server"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <a href="https://discord.gg/WsNudM9" target="_blank" class="btn btn-warning mx-4">
                            <span class="btn-inner--icon font-weight-300"><i class="fab fa-discord font-weight-300 fa-fw"></i></span>
                            <span class="btn-inner--text">Get Help (Discord)</span>
                        </a>
                        <a href="https://www.gmodstore.com/market/view/5853" target="_blank" class="btn btn-default mx-4">
                            <span class="btn-inner--icon font-weight-300"><i class="fas fa-link fa-fw"></i></span>
                            <span class="btn-inner--text">Documentation</span>
                        </a>
                    </div>
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
                                <th scope="col">Name</th>
                                <th scope="col">SteamID</th>
                                <th scope="col">Role</th>
                                <th scope="col">Front Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->steamid }}</td>
                                    <td>
                                        {{$user->getRoleNames()->first()}}
                                    </td>
                                    <td>{{ $user->team->name ?? 'None' }}</td>
                                    <td><a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-primary">View</a></td>
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
