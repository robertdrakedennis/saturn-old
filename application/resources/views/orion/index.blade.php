@extends('layouts.master')

@section('styles')
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/fa.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/orion/app.css') }}" rel="stylesheet">
    <style>
        body:before {
            background-size: cover;
            background: url("{{$setting['background_image']['value']}}") no-repeat center;
        }

    </style>
@endsection

@section('bodyClasses', 'animated fadeIn')

@section('content')
    <div class="container-fluid animated fadeIn">
        <div class="app d-flex flex-fill justify-content-center align-items-center position-relative">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 class="text-light text-center">{{$setting['site_name']['value']}}</h1>
                @if($setting['site_about']['enabled'])
                    <p class="text-light text-center">{{$setting['site_about']['value']}}</p>
                @endif
                <div class="d-flex flex-sm-column flex-md-column flex-lg-row flex-xl-row justify-content-center align-items-center">
                    @foreach($links as $link)
                        <a @if($link->new_tab) target="_blank" @endif
                            href="{{ $link->url }}" class="btn btn-orion btn-orion--outline m-4 text-truncate animated bounceInUp" style="width: 180px;">
                            <span class="btn-orion--icon-wrap text-light"><i class="{{ $link->fa_icon }} fa-fw"></i></span>
                            <span class="btn-orion--text-wrap font-weight-bold text-uppercase">{{ $link->title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection
