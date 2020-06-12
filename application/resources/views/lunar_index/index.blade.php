@extends('layouts.master')
@section('styles')
    <link href="{{ asset('/css/fa.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/lunar_index/app.css') }}" rel="stylesheet">
    <style>
        @if($setting['background_image']['enabled'])
                    header{
            background: url('{{ $setting['background_image']['value'] }}') fixed center center;
        }
        @endif
    </style>
@endsection

@section('content')
    <header>
        <div class="header-cover" style="min-height: 300px;">
            <div class="container h-100">
                <div class="d-flex flex-column align-items-center justify-content-center  h-100">
                    <h1 class="text-white header-text">{{ $setting['site_name']['value'] }}</h1>
                    <h1 class="text-white header-text">{{ $setting['site_about']['value'] }}</h1>
                    <div class="d-flex justify-content-center align-items-center flex-xs-column flex-sm-column flex-md-column flex-lg-row flex-xl-row">
                        @foreach($links as $link)
                            <a @if($link->new_tab) target="_blank" @endif
                            href="{{ $link->url }}" target="_blank" class="btn btn-raised btn-info mx-sm-0 mx-md-2 mx-lg-3 mx-xl-3 my-sm-2 my-md-2 my-lg-1 my-xl-1"><i class="{{ $link->fa_icon }}"></i> {{ $link->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="my-5">
        <div class="container">
            <div class="row mt-4 justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <h1>{{ $setting['features_title']['value'] }}</h1>
                    <p class="h2">{{ $setting['features_about']['value'] }}</p>
                </div>
                <div class="col-12">
                    <div class="card-deck">
                        @foreach($features as $feature)
                            <div class="card shadow-none my-2 border-0 justify-content-center align-items-center text-center" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                @if($feature->display == 'image')
                                    <img class="card-img-top" src="{{ $feature->img_url }}">
                                @endif
                                @if($feature->display == 'fontawesome')
                                    <div class="card-header bg-transparent border-bottom-0 align-items-center">
                                        <i class="{{ $feature->fa_icon }} fa-fw fa-4x" style="color: {{ $feature->fa_color }};"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title">{{ $feature->title }}</h3>
                                    <p class="card-text">{{ $feature->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        @if($setting['servers']['enabled'])
            <div class="col-12 my-4 text-center">
                @if($servers > [])
                    @if($setting['servers_title']['enabled'])
                        <h1>{{ $setting['servers_title']['value'] }}</h1>
                        <p class="h2">{{ $setting['servers_about']['value'] }}</p>
                    @endif
                @endif
                <div class="card-deck">
                    @foreach($servers as $server)
                        <div class="card text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                            @if($server['info']['display'] == 'image')
                                <div class="card-image">
                                    <img class="card-img-top card-server-image" src="{{ $server['info']['img_url'] }}">
                                    <a href="#" class="btn btn-success bmd-btn-fab d-flex justify-content-center align-items-center btn-floating btn-floating-halfway"><i class="fas fa-plug"></i></a>
                                </div>
                            @endif
                            @if($server['info']['display'] == 'fontawesome')
                                <div class="card-header bg-transparent border-0">
                                    <i class="{{ $server['info']['fa_icon'] }} fa-fw fa-4x" style="color: {{ $server['info']['fa_color'] }};"></i>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                @if($server['info']['name'] == null)
                                    <h2 class="card-title">{!! $server['server']['HostName'] !!}</h2>
                                @else
                                    <h2 class="card-title">{{$server['info']['name']}}</h2>
                                @endif
                                <p class="card-text">{{ $server['info']['description'] }}</p>
                                <p>Players: {{ $server['server']['Players'] }}/{{ $server['server']['MaxPlayers'] }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="steam://connect/{{ $server['info']['ip'] . ':' . $server['info']['port'] }}">Connect</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <section class="mt-5 py-5" style="background-color: #3097D1;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    @if($setting['teams']['enabled'])
                        @if($teams->count() > 0)
                            @if($setting['teams_title']['enabled'])
                                <h1 class="text-light">{{ $setting['teams_title']['value'] }}</h1>
                                @if($setting['teams_about']['enabled'])
                                    <p class="h2 text-light">{{ $setting['teams_about']['value'] }}</p>
                                @endif
                            @endif
                            <div class="card-deck">
                                @foreach($teams as $team)
                                    @if($team->users->count() > 0)
                                        <div class="card text-center text-light" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important; background-color: #307AD1;">
                                            @if($team->display == 'image')
                                                <img class="card-img-top" src="{{ $team->img_url }}">
                                            @endif
                                            @if($team->display == 'fontawesome')
                                                <div class="card-header bg-transparent border-0">
                                                    <i class="{{ $team->fa_icon }} p-2  fa-fw fa-4x" style="color: {{ $team->fa_color }};"></i>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <h3 class="card-title">{{$team->name}}</h3>
                                                <p class="card-text">{{ $team->description }}</p>
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            @foreach($team->users->take(3) as $user)
                                                                <div class="d-flex flex-column mx-3">
                                                                    <a href="https://steamcommunity.com/profiles/{{$user->steamid}}" target="_blank">
                                                                        <img src="{{ $user->avatar }}" class="mb-3" style="height: 4.5rem; width: 4.5rem; border-radius: 100vh;">
                                                                    </a>
                                                                    <h3 class="card-title">{{ $user->name }}</h3>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if($team->users->count() > 3)
                                                            <div class="card-footer">
                                                                <button type="button" data-toggle="modal" data-target="#staffMembers{{$team->id}}" class="btn btn-primary text-light">View all members</button>
                                                                <div class="modal fade" id="staffMembers{{$team->id}}" tabindex="-1" role="dialog" aria-labelledby="staffMembersLabel{{$team->id}}" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header border-bottom-0">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h3 class="text-center">Viewing  {{ $team->name }}</h3>
                                                                                <div class="card-deck">
                                                                                    @foreach($team->users as $user)
                                                                                        <div class="card text-center my-3 border-0 shadow-none" style="-ms-flex-preferred-size: 110px!important;    flex-basis: 110px!important;">
                                                                                            <div class="card-body">
                                                                                                <div class="d-flex flex-column mx-3 justify-content-center align-items-center">
                                                                                                    <a href="https://steamcommunity.com/profiles/{{$user->steamid}}" target="_blank">
                                                                                                        <img src="{{ $user->avatar }}" class="mb-3" style="height: 4.5rem; width: 4.5rem; border-radius: 100vh;">
                                                                                                    </a>
                                                                                                    <h4>{{ $user->name }}</h4>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center text-light">
            @auth
                @if(Auth::user()->hasAnyRole(['root', 'admin']))
                    <a class="mx-2 mt-5 text-dark btn btn-raised btn-light" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                @endif
                <a class="mx-2 mt-5 text-dark btn btn-raised btn-light" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            @endauth
            @guest
                <a class="mx-2 mt-5 text-dark btn btn-raised btn-light" href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Sign In</a>
            @endguest
        </div>
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/bootstrap-material.js') }}"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
@endsection