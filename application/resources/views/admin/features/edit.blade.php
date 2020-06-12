@extends('layouts.master')
@section('title', 'Editing Feature - ' . $feature->title)
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fas fa-fire"></i> Editing Feature: {{ $feature->id }} - {{$feature->title}}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    @if($feature->display == 'image')
                        <img class="card-img-top" src="{{ $feature->img_url }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$feature->title}}</h5>
                        @if($feature->display == 'fontawesome')
                            <i class="{{  $feature->fa_icon }} fa-fw fa-6x py-2" id="fontAwesomeIcon" style="color: {{ $feature->fa_color }};"></i>
                        @endif
                        <p class="card-text">{{ $feature->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ action('Dashboard\FeaturesController@Update', $feature) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="titleInput">Title</label>
                                <input type="text" class="form-control form-control-alternative" name="title" id="titleInput" aria-describedby="titleHelp" value="{{ $feature->title }}" required>
                                <small id="titleHelp" class="form-text text-muted">Try to keep it short and sweet. :)</small>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" value="{{ $feature->fa_icon }}">
                                <small id="fontAwesomeHelp" class="form-text text-muted">You can go to: <a href="https://fontawesome.com/icons">here</a> find a icon you want, and then copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="imageInput">Image URL</label>
                                <input type="text" class="form-control form-control-alternative" name="img_url" id="imageInput" aria-describedby="imageHelp" value="{{ $feature->img_url }}">
                                <small id="imageHelp" class="form-text text-muted">Any image url ending in an extension (jpg, jpeg, png, etc).</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div id="counter" class="text-muted"></div>
                                <textarea id="description" class="form-control form-control-alternative" name="description" aria-describedby="descriptionHelp" rows="3">{{ $feature->description }}</textarea>
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
                                <input type='text' id="color" name="fa_color" value="#{{ $feature->fa_color }}" />
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Update</button>
                        </form>
                        <form  action="{{ action('Dashboard\FeaturesController@Destroy', $feature->id) }}" method="POST">
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
