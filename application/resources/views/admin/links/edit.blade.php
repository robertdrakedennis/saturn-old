@extends('layouts.master')
@section('title', 'Editing Link - ' . $link->title)
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fas fa-link"></i> Editing {{ $link->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column text-center justify-content-center align-items-center">
                        <h5 class="card-title">{{$link->title}}</h5>
                        <i class="{{ $link->fa_icon }} fa-fw fa-6x py-2 text-dark"></i>
                        <a href="{{ $link->url }}" target="_blank" class="card-text">{{ $link->title }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ action('Dashboard\LinkController@Update', $link) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="titleInput">Title</label>
                                <input type="text" class="form-control form-control-alternative" name="title" id="titleInput" aria-describedby="titleHelp" value="{{ $link->title }}" required>
                                <small id="titleHelp" class="form-text text-muted">Try to keep it short and sweet. :)</small>
                            </div>
                            <div class="form-group">
                                <label for="urlInput">Url</label>
                                <input type="text" class="form-control form-control-alternative" name="url" id="urlInput" aria-describedby="urlHelp" value="{{ $link->url }}" required>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" value="{{ $link->fa_icon }}">
                                <small id="fontAwesomeHelp" class="form-text text-muted">You can go to: <a href="https://fontawesome.com/icons">here</a> find a icon you want, and then copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="tabInput">Open in a new tab?</label>
                                <select class="form-control form-control-alternative" name="new_tab" id="tabInput">
                                    <option value="1" @if($link->new_tab) selected @endif>Yes</option>
                                    <option value="0" @if(!$link->new_tab) selected @endif>No</option>
                                </select>
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Update</button>
                        </form>
                        <form  action="{{ action('Dashboard\LinkController@Destroy', $link) }}" method="POST">
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
