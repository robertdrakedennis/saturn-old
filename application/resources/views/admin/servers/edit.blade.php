@extends('layouts.master')
@section('title', 'Editing Server - ' . $server->name)

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fas fa-server"></i> Editing {{ $server->name ?? $info['HostName'] }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Servers</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    @if($server->display == 'image')
                        <img class="card-img-top" src="{{ $server->img_url }}" style="height: 12rem;">
                    @endif
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        @if($server->name == null)
                            <h2 class="card-title">{!! $info['HostName'] !!}</h2>
                        @else
                            <h2 class="card-title">{{$server->name}}</h2>
                        @endif
                        @if($server->display == 'fontawesome')
                            <i class="{{ $server->fa_icon }} fa-fw fa-6x py-2" id="fontAwesomeIcon" style="color: {{ $server->fa_color }};"></i>
                        @endif
                        <p class="card-text">{{ $server->description }}</p>
                        <p>Players: {{ $info['Players'] }}/{{ $info['MaxPlayers'] }}</p>
                        <div class="d-flex flex-row justify-content-center">
                            <form  action="{{ action('Dashboard\ServersController@Destroy', $server) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger mx-1">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ action('Dashboard\ServersController@Update', $server) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="nameInput">Name</label>
                                <input type="text" class="form-control form-control-alternative" name="name" id="nameInput" aria-describedby="nameHelp" value="{{ $server->name }}">
                                <small id="nameHelp" class="form-text text-muted">Try to keep it short and sweet. :)</small>
                            </div>
                            <div class="form-group">
                                <label for="ipInput">IP</label>
                                <input type="text" class="form-control form-control-alternative" name="ip" id="ipInput" aria-describedby="ipHelp" value="{{ $server->ip }}" required>
                                <small id="ipHelp" class="form-text text-muted">Do not enter the port. Example: <code>127.0.0.1</code></small>
                            </div>
                            <div class="form-group">
                                <label for="ipInput">Port</label>
                                <input type="text" class="form-control form-control-alternative" name="port" id="portInput" aria-describedby="portHelp" value="{{ $server->port }}" required>
                                <small id="portHelp" class="form-text text-muted">Do not enter the IP. Example: <code>8000</code></small>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" value="{{ $server->fa_icon }}">
                                <small id="fontAwesomeHelp" class="form-text text-muted">You can go to: <a href="https://fontawesome.com/icons">here</a> find a icon you want, and then copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="imageInput">Image URL</label>
                                <input type="text" class="form-control form-control-alternative" name="img_url" id="imageInput" aria-describedby="imageHelp" value="{{ $server->img_url }}">
                                <small id="imageHelp" class="form-text text-muted">Any image url ending in an extension (jpg, jpeg, png, etc).</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div id="counter" class="text-muted"></div>
                                <textarea id="description" class="form-control form-control-alternative" name="description" aria-describedby="descriptionHelp" rows="3">{{ $server->description }}</textarea>
                                <small id="descriptionHelp" class="form-text text-muted">Optional: 1000 Characters is the maximum</small>
                            </div>
                            <div class="form-group">
                                <label for="enable">Display Fontawesome or Image</label>
                                <select class="form-control form-control-alternative" name="display" id="enable">
                                    <option value="fontawesome">Font Awesome</option>
                                    <option value="image">Image Url</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color">Select a Color your FontAwesome Icon</label>
                                <input type='text' id="color" name="fa_color"  value="{{ $server->fa_color }}" />
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Update</button>
                        </form>

                        <form  action="{{ action('Dashboard\ServersController@Destroy', $server->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger mt-1">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('extraScripts')
    <script>
        $( document ).ready(function() {
            $("#enable").val("{{$server->display}}");
        });
    </script>
@endsection
