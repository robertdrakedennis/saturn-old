@extends('layouts.master')
@section('styles')
    <link href="{{ asset('/css/fa.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/argon.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/witch/app.css') }}" rel="stylesheet">
    @if($setting['background_image']['enabled'])
        <style>
            .header-overlay::before{
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, .5);
            }
        </style>
    @endif
@endsection

@section('content')
    <div class="main-content">
        <nav class="navbar navbar-top navbar-expand-md navbar-dark">
            <div class="container-fluid justify-content-end align-items-end">
                <ul class="navbar-nav px-3">
                    @auth
                        @if(Auth::user()->hasAnyRole(['root', 'admin']))
                            <li class="nav-item text-nowrap">
                                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item text-nowrap">
                            <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Sign out</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item text-nowrap">
                            <a class="navbar-brand nav-link" href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Sign In</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <header class="header bg-gradient-primary header-overlay py-7 py-lg-8 d-flex flex-column justify-content-center align-items-center" @if($setting['background_image']['enabled']) style="background: url('{{ $setting['background_image']['value'] }}') no-repeat center !important; background-attachment: fixed; -webkit-background-size: cover!important;background-size: cover!important;" @endif>
            <div class="container position-relative">
                <div class="header-body text-center mb-4">
                    <div class="pt-md-3 pb-md-4 text-center">
                        @if($setting['site_logo']['enabled'])
                            <img src="{{ $setting['site_logo']['value'] }}" class="img-fluid logo" style="height: 10.5rem; width: 10.5rem;">
                        @endif
                        <h1 class="display-4 text-white mb-0">{{ $setting['site_name']['value'] }}</h1>
                        <p class="lead text-white mt-0">{{ $setting['site_about']['value'] }}</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-xs-column flex-sm-column flex-md-column flex-lg-row flex-xl-row">
                        @foreach($links as $link)
                            <a @if($link->new_tab) target="_blank" @endif
                            href="{{ $link->url }}" target="_blank" class="btn btn-outline-white mx-sm-0 mx-md-2 mx-lg-3 mx-xl-3 my-sm-2 my-md-2 my-lg-1 my-xl-1 link draw meet"><i class="{{ $link->fa_icon }} fa-fw"></i> {{ $link->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </header>
        <div class="container mt--2 pb-5">
            <div class="row justify-content-center">
                @if($features->count() > 0)
                    @if($setting['features']['enabled'])
                        <div class="col-12">
                            @if($setting['features_title']['enabled'])
                                <div class="text-center pt-5 pb-3">
                                    <h1 class="display-4 text-white my-0">{{ $setting['features_title']['value'] }}</h1>
                                    @if($setting['features_about']['enabled'])
                                        <p class="lead text-white-50 my-0">{{ $setting['features_about']['value'] }}</p>
                                    @endif
                                    <hr>
                                </div>
                            @endif
                            @endif
                            <div class="card-deck">
                                @foreach($features as $feature)
                                    <div class="card mb-4 drawcard drawmeet" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                        @if($feature->display == 'image')
                                            <img class="card-img-top" src="{{ $feature->img_url }}">
                                        @endif
                                        <div class="card-body">
                                            <h2 class="card-title mb-0">{{$feature->title}}</h2>
                                            @if($feature->display == 'fontawesome')
                                                <div class="icon-shape icon-lg text-white rounded-circle my-3" style="height: 4.5rem; width: 4.5rem; background-color: {{ $feature->fa_color }};">
                                                    <i class="{{ $feature->fa_icon }} fa-fw fa-6x py-2"></i>
                                                </div>
                                            @endif
                                            <p class="card-text my-0">{{ $feature->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($setting['discord']['enabled'])
                        <div class="col-sm-12 col-lg-6 my-4">
                            @if($setting['discord_title']['enabled'])
                                <div class="text-center pt-5 pb-3">
                                    <h1 class="display-4 text-white my-0">{{  $setting['discord_title']['value'] }}</h1>
                                    @if($setting['discord_about']['enabled'])
                                        <p class="lead text-white-50 my-0">{{  $setting['discord_about']['value'] }}</p>
                                    @else
                                        <br class="lead text-white-50 my-0">
                                    @endif
                                    <hr>
                                </div>
                            @endif
                            <a href="{{ $discord->instant_invite }}">
                                <div class="card-deck clicky-card">
                                    <div class="card my-3 drawcard" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                        <div class="card-body">
                                            <h3 class="card-title mb-0">{{ $discord->name }}</h3>
                                            <div class="icon-shape icon-lg bg-primary text-white rounded-circle my-3" style="height: 4.5rem; width: 4.5rem;">
                                                <i class="fab fa-discord fa-fw fa-6x font-weight-300"></i>
                                            </div>
                                            <p class="my-0 text-white-50">{{ count($discord->members) }} Members Online</p>
                                        </div>
                                    </div>
                                </div></a>
                        </div>
                    @endif

                    @if($setting['steam_group']['enabled'])
                        <div class="col-sm-12 col-lg-6 my-4">
                            @if( $setting['steam_group_title']['enabled'])
                                <div class="text-center pt-5 pb-3">
                                    <h1 class="display-4 text-white my-0">{{  $setting['steam_group_title']['value'] }}</h1>
                                    @if($setting['steam_group_about']['enabled'])
                                        <p class="lead text-white-50 my-0">{{  $setting['steam_group_about']['value'] }}</p>
                                    @else
                                        <br class="lead text-white-50 my-0">
                                    @endif
                                    <hr>
                                </div>
                            @endif
                            <a href="{{ $steam->group_url }}">

                                <div class="card-deck clicky-card">
                                    <div class="card my-3 drawcard" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                        <div class="card-body">
                                            <h3 class="card-title mb-0">{{ (string) $steamLoadedInfo->groupDetails->groupName }}</h3>
                                            <div class="icon-shape icon-lg bg-primary text-white rounded-circle my-3" style="height: 4.5rem; width: 4.5rem;">
                                                <img src="{{ (string) $steamLoadedInfo->groupDetails->avatarFull }}" style="height: 4.5rem; width: 4.5rem; -webkit-border-radius: 100vh;-moz-border-radius: 100vh;border-radius: 100vh;">
                                            </div>
                                            <p class="my-0 text-white-50">{{ $steamLoadedInfo->groupDetails->membersOnline . ' / ' . $steamLoadedInfo->groupDetails->memberCount }} Members Online</p>
                                        </div>
                                    </div>
                                </div></a>
                        </div>

                    @endif

                    @if($setting['servers']['enabled'])
                        <div class="col-sm-12 col-lg-12 my-4">
                            @if($servers > [])
                                @if($setting['servers_title']['enabled'])
                                    <div class="text-center pt-5 pb-3">
                                        <h1 class="display-4 text-white my-0">{{ $setting['servers_title']['value'] }}</h1>
                                        @if($setting['servers_about']['enabled'])
                                            <p class="lead text-white-50 my-0">{{ $setting['servers_about']['value'] }}</p>
                                        @endif
                                        <hr>
                                    </div>
                                @endif
                            @endif
                            <div class="card-deck justify-content-center">
                                @foreach($servers as $server)
                                    @if($server['server']['MaxPlayers'] != 0)
                                        @php $calc = $server['server']['Players'] / $server['server']['MaxPlayers'] * 100; @endphp
                                    @else
                                        @php
                                            $server['server']['MaxPlayers'] = 0;
                                            $server['server']['Players'] = 0;
                                            $server['server']['Map'] = "no_map";
                                            $server['server']['HostName'] = "offline_server";
                                            $calc = 0;
                                        @endphp
                                    @endif
                                    <a href="steam://connect/{{ $server['info']['ip'] . ':' . $server['info']['port'] }}" class="scard">
                                        <div class="card text-center" style="width: 20rem;">
                                            @if($server['info']['display'] == 'image')
                                                <img class="card-img-top" src="{{ $server['info']['img_url'] }}" style="height: 12rem;">
                                            @else
                                                <div class="card-icon-top">
                                                    <div class="icon-shape icon-lg text-white rounded-circle shadow my-2" style="margin-top: 30% !important; height: 4.5rem; width: 4.5rem; background-color: {{ $server['info']['fa-color'] }};">
                                                        <i class="{{ $server['info']['fa_icon'] }} fa-fw fa-6x py-2"></i>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <button class="m-3 btn btn-outline-<?php if($server['server']['MaxPlayers'] !== 0){echo 'success';}else{echo 'danger';}?>"><?php if($server['server']['MaxPlayers'] !== 0){echo 'ONLINE';}else{echo 'OFFLINE';}?></button>

                                                @if($server['info']['name'] == null)
                                                    <h2 class="card-title">{!! $server['server']['HostName'] !!}</h2>
                                                @else
                                                    <h2 class="card-title">{{$server['info']['name']}}</h2>
                                                @endif
                                                <p class="card-text servertxt">{{ $server['info']['description']}}</p>
                                                <p class="card-text servertxt">Map: <span>{{$server['server']['Map']}}</span></p>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{$calc}}%" aria-valuenow="{{$calc}}" aria-valuemin="0" aria-valuemax="{{$calc}}"></div>
                                                </div>
                                                <p class="card-text servertxt">Players: {{ $server['server']['Players'] }} / {{ $server['server']['MaxPlayers'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($setting['teams']['enabled'])
                        <div class="col-sm-12 col-lg-12 my-4">
                            @if($teams->count() > 0)
                                @if($setting['teams_title']['enabled'])
                                    <div class="text-center pt-5 pb-3">
                                        <h1 class="display-4 text-white my-0">{{ $setting['teams_title']['value'] }}</h1>
                                        @if($setting['teams_about']['enabled'])
                                            <p class="lead text-white-50 my-0">{{ $setting['teams_about']['value'] }}</p>
                                        @endif
                                        <hr>
                                    </div>
                                @endif
                            @endif
                            <div class="card-deck">
                                @foreach($teams as $team)
                                    @if($team->users->count() > 0)
                                        <div class="card shadow shadow-lg--hover text-center" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                            @if($team->display == 'image')
                                                <img class="card-img-top" src="{{ $team->img_url }}">
                                            @endif
                                            <div class="card-body">
                                                @if($team->display == 'fontawesome')
                                                    <div class="icon-shape icon-lg text-white rounded-circle shadow my-2" style="height: 4.5rem; width: 4.5rem; background-color: {{ $team->fa_color }};">
                                                        <i class="{{ $team->fa_icon }} fa-fw fa-6x py-2"></i>
                                                    </div>
                                                @endif
                                                <h2 class="card-title">{{$team->name}}</h2>
                                                <p class="card-text">{{ $team->description }}</p>
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            @foreach($team->users  as $user)
                                                                @if($loop->iteration % 3 == 1)

                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">

                                                            @endif


                                                            <div class="d-flex flex-column mx-3">
                                                                <img class="mx-auto" src="{{ $user->avatar }}" style="height: 4.5rem; width: 4.5rem; border-radius: 100vh;">
                                                                <h4 class="text-white-50 pt-3">{{ $user->name }}</h4>
                                                            </div>
                                                            <br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
@endsection
