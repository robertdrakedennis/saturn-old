@extends('layouts.master')
@section('title', 'User -' . $user->name)

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light">Viewing {{ $user->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center justify-content-center align-items-center">
                    <div class="card-body">
                        <img src="{{ $user->avatar }}" style="width: 7.5rem; height: auto; border-radius: 50%"/>
                        <h2 class="card-title text-center">{{ $user->name }}</h2>
                        <div class="d-flex flex-column text-left mx-5">
                            <h4 class="card-title">Steamid: <code>{{ $user->steamid }}</code></h4>
                            <h4 class="card-title">Panel Rank: <code>{{ $user->getRoleNames()->first() }}</code>
                            </h4>
                            @if($user->team == null)
                                <h4 class="card-title">Team:<code> User has no team.</code></h4>
                            @else
                                <h4 class="card-title">Team:<code> {{$user->team->name}}</code></h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form class="pb-2" action="{{ action('Dashboard\UsersController@Update', $user) }}"  method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="userNameInput">Username</label>
                                <input type="text" class="form-control form-control-alternative" name="name" id="userNameInput" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="teamRankSelect">Team </label>
                                <select class="form-control form-control-alternative" id="teamRankSelect" name="team_id">
                                    @if($user->team == null)
                                        <option>No Current Team.</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" @if($team->id == $user->team_id) selected @endif>{{$team->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="panelRankSelect">Panel Rank</label>
                                @if($user->getRoleNames()->first() == 'root')
                                    <select class="form-control form-control-alternative" id="panelRankSelect" name="role" disabled>
                                        <option>You are a Root User</option>
                                    </select>
                                @else
                                    <select class="form-control form-control-alternative" id="panelRankSelect" name="role">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @if($user->team != null)
                            <form method="POST" class="py-2" action="{{ action('Dashboard\UsersController@RemoveTeam', $user) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Remove Team</button>
                            </form>
                        @else
                            <button type="submit" class="btn btn-danger" disabled>Remove Team</button>
                        @endif
                        <form method="POST" class="py-2" action="{{ action('Dashboard\UsersController@syncWithSteam', $user) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-success">Sync with Steam</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extraScripts')
    <script>

        @if($user->getRoleNames()->first() == 'root')
        @else
        $( document ).ready(function() {
            $("#panelRankSelect").val("{{$user->getRoleNames()->first()}}");
        });
        @endif
    </script>
@endsection
