@extends('layouts.master')
@section('title', 'Editing Team - ' . $team->name)

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fas fa-users"></i> Editing {{ $team->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    @if($team->display == 'image')
                        <img class="card-img-top" src="{{ $team->img_url }}">
                    @endif
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h2 class="card-title">{{$team->name}}</h2>
                        @if($team->display == 'fontawesome')
                            <i class="{{ $team->fa_icon }} fa-fw fa-6x py-2" id="fontAwesomeIcon" style="color: {{ $team->fa_color }};"></i>
                        @endif
                        <p class="card-text">{{ $team->description }}</p>

                        <p class="card-text text-center">Users: {{ $team->users()->count() }}</p>
                        <ul class="list-group list-group-flush">
                            @foreach($team->users as $user)
                                <li class="list-group-item">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                        <div class="d-flex flex-row justify-content-center">
                            <form  action="{{ action('Dashboard\TeamController@Destroy', $team) }}" method="POST">
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
                        <form action="{{ action('Dashboard\TeamController@Update', $team) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="nameInput">Name</label>
                                <input type="text" class="form-control form-control-alternative" name="name" id="nameInput" aria-describedby="nameHelp" value="{{ $team->name }}">
                                <small id="nameHelp" class="form-text text-muted">Try to keep it short and sweet. :)</small>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" value="{{ $team->fa_icon }}">
                                <small id="fontAwesomeHelp" class="form-text text-muted">You can go to: <a href="https://fontawesome.com/icons">here</a> find a icon you want, and then copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="imageInput">Image URL</label>
                                <input type="text" class="form-control form-control-alternative" name="img_url" id="imageInput" aria-describedby="imageHelp" value="{{ $team->img_url }}">
                                <small id="imageHelp" class="form-text text-muted">Any image url ending in an extension (jpg, jpeg, png, etc).</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div id="counter" class="text-muted"></div>
                                <textarea id="description" class="form-control form-control-alternative" name="description" aria-describedby="descriptionHelp" rows="3">{{ $team->description }}</textarea>
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
                                <input type='text' id="color" name="fa_color"  value="{{ $team->fa_color }}" />
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Update</button>
                        </form>

                        <form  action="{{ action('Dashboard\ServersController@Destroy', $team) }}" method="POST">
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
            $("#enable").val("{{$team->display}}");
        });

    </script>
@endsection