@extends('layouts.master')
@section('title', 'Servers')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light mb-0"><i class="fas fa-server"></i> Servers</h1>
                    <p class="header text-light my-0">There are currently {{ $servers->count() }} servers.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ action('Dashboard\ServersController@Store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nameInput">Name</label>
                                <input type="text" class="form-control form-control-alternative" name="name" id="nameInput" aria-describedby="nameHelp" placeholder="Enter Name">
                                <small id="nameHelp" class="form-text text-muted">Try to keep it short and sweet. :)</small>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 col-lg-9">
                                    <div class="form-group">
                                        <label for="ipInput">IP Address</label>
                                        <input type="text" class="form-control form-control-alternative" name="ip" id="ipInput" aria-describedby="ipHelp" placeholder="Enter IP" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="ipInput">Port</label>
                                        <input type="text" class="form-control form-control-alternative" name="port" id="portInput" aria-describedby="portHelp" placeholder="Enter Port" required>
                                    </div>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" placeholder="Enter Font-Awesome Icon (Optional)">
                                <small id="fontAwesomeHelp" class="form-text text-muted">You can go to: <a href="https://fontawesome.com/icons">here</a> find a icon you want, and then copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="imageInput">Image URL</label>
                                <input type="text" class="form-control form-control-alternative" name="img_url" id="imageInput" aria-describedby="imageHelp" placeholder="Enter Image Url (Optional)">
                                <small id="imageHelp" class="form-text text-muted">Any image url ending in an extension (jpg, jpeg, png, etc).</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control form-control-alternative" name="description" aria-describedby="descriptionHelp" rows="3" placeholder="Enter Description (Optional)"></textarea>
                                <small id="counter" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="enable">Display Font Awesome or Image</label>
                                <select class="form-control form-control-alternative" name="display" id="enable">
                                    <option value="fontawesome">Font Awesome</option>
                                    <option value="image">Image Url</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color">Font Awesome Icon Color</label>
                                <input type='text' id="color" name="fa_color" value="#333639" />
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Create Server</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-deck py-5">
            @foreach($servers as $server)
                @php
                    $info =  (new App\Models\Server)->Info($server);
                @endphp
                <div class="card text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                    @if($server->display == 'image')
                        <img class="card-img-top" src="{{ $server->img_url }}" style="height: 12rem;">
                    @endif
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        @if($server->name == null)
                            <h5 class="card-title">{!! $info['HostName'] !!}</h5>
                        @else
                            <h5 class="card-title">{{$server->name}}</h5>
                        @endif
                        @if($server->display == 'fontawesome')
                            <i class="{{ $server->fa_icon }} fa-fw fa-6x py-2" style="color: {{ $server->fa_color }};"></i>
                        @endif
                        <p class="card-text">{{ $server->description }}</p>
                        <p>Players: {{ $info['Players'] }}/{{ $info['MaxPlayers'] }}</p>
                        <div class="d-flex flex-row justify-content-center">
                            <a href="{{ route('dashboard.servers.edit', $server) }}" class="btn btn-primary mx-1">Edit</a>
                            <form  action="{{ action('Dashboard\ServersController@Destroy', $server->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger mx-1">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
