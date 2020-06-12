@extends('layouts.master')
@section('title', 'Teams')


@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light mb-0"><i class="fas fa-users"></i> Teams</h1>
                    <p class="header text-light my-0">There are currently {{ $teams->count() }} teams.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ route('dashboard.team.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nameInput">Name</label>
                                <input type="text" class="form-control form-control-alternative" name="name" id="nameInput" aria-describedby="nameHelp" placeholder="Enter Name">
                                <small id="nameHelp" class="form-text text-muted">Try to keep it short and sweet. :)</small>
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
                                <input type='text' id="color" name="fa_color"  value="#333639" />
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Create Team</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-deck my-4">
            @foreach($teams as $team)
                <div class="card text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                    @if($team->display == 'image')
                        <img class="card-img-top" src="{{ $team->img_url }}">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title mb-0">{{$team->name}}</h2>
                        @if($team->display == 'fontawesome')
                            <i class="{{ $team->fa_icon }} fa-fw fa-4x my-3" style="color: {{ $team->fa_color }};"></i>
                        @endif
                        <p class="card-text">{{ $team->description }}</p>
                        <div class="d-flex flex-row justify-content-center">
                            <a href="{{ route('dashboard.team.edit', $team) }}" class="btn btn-primary mx-1">Edit</a>
                            <form  action="{{ action('Dashboard\TeamController@Destroy', $team) }}" method="POST">
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
