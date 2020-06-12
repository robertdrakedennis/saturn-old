@extends('layouts.master')
@section('title', 'Links')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light mb-0"><i class="fas fa-link"></i> Links</h1>
                    <p class="header text-light my-0">There are currently {{ $links->count() }} links.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ action('Dashboard\LinkController@Store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="titleInput">Title</label>
                                <input type="text" class="form-control form-control-alternative" name="title" id="titleInput" aria-describedby="titleHelp" placeholder="Enter Title" required>
                                <small id="titleHelp" class="form-text text-muted">Try to keep it short and sweet :)</small>
                            </div>
                            <div class="form-group">
                                <label for="urlInput">URL</label>
                                <input type="text" class="form-control form-control-alternative" name="url" id="urlInput" aria-describedby="urlHelp" placeholder="Enter URL" required>
                                <small id="urlHelp" class="form-text text-muted">This is where your link will direct to.</small>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" placeholder="Enter Font-Awesome Icon (Optional)">
                                <small id="fontAwesomeHelp" class="form-text text-muted">Find the icon you want <a href="https://fontawesome.com/icons">here</a>, and copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="tabInput">Open in a new tab?</label>
                                <select class="form-control form-control-alternative" name="new_tab" id="tabInput">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-deck my-4">
            @foreach($links as $link)
                <div class="card text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                    <div class="card-body">
                        <h2 class="card-title mb-0">{{$link->title}}</h2>
                        <i class="{{ $link->fa_icon }} fa-fw fa-4x my-3 text-dark"></i>
                        <div class="d-flex flex-row justify-content-center">
                            <a href="{{ $link->url }}" target="_blank" class="btn btn-primary mx-1">Test</a>
                            <a href="{{ route('dashboard.links.edit', $link) }}" class="btn btn-primary mx-1">Edit</a>
                            <form action="{{ action('Dashboard\LinkController@Destroy', $link) }}" method="POST">
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
