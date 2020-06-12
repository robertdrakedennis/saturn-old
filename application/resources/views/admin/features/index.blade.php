@extends('layouts.master')
@section('title', 'Features')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light mb-0"><i class="fas fa-fire"></i> Features</h1>
                    <p class="header text-light my-0">There are currently {{ $features->count() }} features.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{ action('Dashboard\FeaturesController@Store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="titleInput">Title</label>
                                <input type="text" class="form-control form-control-alternative" name="title" id="titleInput" aria-describedby="titleHelp" placeholder="Enter Title" required>
                                <small id="titleHelp" class="form-text text-muted">Try to keep it short and sweet :)</small>
                            </div>
                            <div class="form-group">
                                <label for="fontAwesomeInput">Font Awesome Icon</label>
                                <input type="text" class="form-control form-control-alternative" name="fa_icon" id="fontAwesomeInput" aria-describedby="fontAwesomeHelp" placeholder="Enter Font-Awesome Icon (Optional)">
                                <small id="fontAwesomeHelp" class="form-text text-muted">Find the icon you want <a href="https://fontawesome.com/icons">here</a>, and copy the FULL class. Example: <code>fab fa-discord</code></small>
                            </div>
                            <div class="form-group">
                                <label for="imageInput">Image URL</label>
                                <input type="text" class="form-control form-control-alternative" name="img_url" id="imageInput" aria-describedby="imageHelp" placeholder="Enter Image Url (Optional)">
                                <small id="imageHelp" class="form-text text-muted">This is the direct URl to the image that will show if you decide to show an image instead of a Font Awesome icon.</small>
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
                                    <option value="image">Image URL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color" class="mr-2">Font Awesome Icon Color</label>
                                <input type="text" id="color" name="fa_color" value="#333639">
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Create Feature</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-deck my-4">
            @foreach($features as $feature)
                <div class="card text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                    @if($feature->display == 'image')
                        <img class="card-img-top" src="{{ $feature->img_url }}">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title mb-0">{{$feature->title}}</h2>
                        @if($feature->display == 'fontawesome')
                            <i class="{{ $feature->fa_icon }} fa-fw fa-4x my-3" style="color: {{ $feature->fa_color }};"></i>
                        @endif
                        <p class="card-text mb-3">{{ $feature->description }}</p>
                        <div class="d-flex flex-row justify-content-center">
                            <a href="{{ route('dashboard.features.edit', $feature->id) }}" class="btn btn-dark mx-1">Edit</a>
                            <form  action="{{ action('Dashboard\FeaturesController@Destroy', $feature->id) }}" method="POST">
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

