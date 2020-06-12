@extends('layouts.master')
@section('title', 'Themes')
@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fas fa-paint-roller"></i> Themes</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="card shadow-lg text-center">
            <div class="card-body">
                <h2 class="card-title">Current Theme: {{ $currentTheme->currentTheme->name }}</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#themeModal">Change Theme</button>
                <div class="modal fade" id="themeModal" tabindex="-1" role="dialog" aria-labelledby="themeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="themeModalLabel">Change Current Theme</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ action('Dashboard\ThemesController@Update', $currentTheme) }}">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="row my-4">
                                        @foreach($allThemes as $theme)
                                            <div class="col-3 p-3">
                                                <div class="input-group input-group-alternative">
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <div>
                                                            <img src="{{ $theme->image }}" class="img-thumbnail" style="width: 150px; height: 84px;" />
                                                        </div>
                                                        <div class="custom-control custom-radio d-flex flex-column">
                                                            <input class="custom-control-input" name="theme" type="radio" id="themeCheckBox{{ $theme->id }}" value="{{ $theme->id }}" @if($theme->id  === $currentTheme->current_theme_id ) checked @endif />
                                                            <label class="custom-control-label my-auto" for="themeCheckBox{{ $theme->id }}">{{ $theme->name }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection