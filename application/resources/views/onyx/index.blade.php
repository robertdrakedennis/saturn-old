@extends('layouts.master')
@section('styles')
    <link href="{{ asset('/css/fa.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/argon.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/onyx/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,800" rel="stylesheet">
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
    <body>
    <div class="jumbotron pageheader01" @if($setting['background_image']['enabled']) style="background-image: url({{ asset('/img/onyx/app.svg') }});" @endif>
        <div class="navwrapper">
            <div class="d-flex justify-content-center align-items-center flex-xs-column flex-sm-column flex-md-column flex-lg-row flex-xl-row mt-5">
                @foreach($links as $link)
                    <a href="{{ $link->url }}" target="_blank" class="btn btn-primary onyx-nav-btn mx-sm-0 mx-md-2 mx-lg-3 mx-xl-3 my-sm-2 my-md-2 my-lg-1 my-xl-1"><i class="{{ $link->fa_icon }}"></i> {{ $link->title }}</a>
                @endforeach
            </div>
        </div>
        <div class="pageheader01-contentbox">
            <div class="cbwrapper">
                <h1 class="sitename">{{ $setting['site_name']['value'] }}</h1>
                <p class="lead">{{ $setting['site_about']['value'] }}</p>
            </div>
        </div>
    </div>
    <div class="container-fluid pagefeature" id="pagefeature">
        <h2 class="display-4 pageglobal-headericon"><i class="fa fa-diamond" aria-hidden="true"></i></h2>
        @if($features->count() > 0)
            @if($setting['features']['enabled'])
                    @if($setting['features_title']['enabled'])
                    <h4 class="display-5 pageglobal-headertitle">{{ $setting['features_title']['value'] }}</h4>
                            @if($setting['features_about']['enabled'])
                        <p class="lead pageglobal-headersubtitle">{{ $setting['features_about']['value'] }}</p>
                            @endif
                    @endif
            @endif
    <div class="container">
        <div class="row">
            @foreach($features as $feature)
                <div class="col-md-4">
                    <div class="pagefeature-card">
                        <div class="pagefeature-cardtitle">{{$feature->title}}</div>
                        <div class="pagefeature-cardicon"><i class="fa @if($feature->display == 'fontawesome'){{ $feature->fa_icon }} @endif @if($feature->display == 'image') fa-cogs @endif pagefeature-cardiconspl" aria-hidden="true"></i></div>
                        <div class="pagefeature-carddescription">{{ $feature->description }}</div>
                    </div>
                </div>
            @endforeach
         @endif
        </div>
    </div>
    </div>
    <br>

    <div class="container-fluid pagestaff" id="pagestaff">
        @if($setting['teams']['enabled'])
            @if($teams->count() > 0)
                @if($setting['teams_title']['enabled'])
                    <div class="pagestaff-title d-flex flex-column align-items-center justify-content-center">
                        <h4 class="display-5 pageglobal-headertitle ph2">{{ $setting['teams_title']['value'] }}</h4>
                        @if($setting['teams_about']['enabled'])
                            <p class="lead pageglobal-headersubtitle ph2">{{ $setting['teams_about']['value'] }}</p>
                        @endif
                        <br><br>
                    </div>
                @endif
            @endif
            @foreach($teams as $team)
                    <div class="team-wrapper container">
                        <div class="teaminfo-wrapper d-flex flex-column align-items-center justify-content-center">
                            @if($team->display == 'fontawesome')
                                <div class="teamicon-wrapper d-flex flex-column align-items-center justify-content-center"><i class="{{ $team->fa_icon }}" aria-hidden="true"></i></div><br>
                            @endif
                            <h3>{{$team->name}}</h3>
                            <p>{{ $team->description }}</p>
                            <br>
                        </div>
                        <div class="row">
                            @foreach($team->users as $user)
                                <div class="col-md-4">
                                    <div class="pagestaff-steaminfobox">
                                        <div class="pagestaff-steamname">{{ $user->name }}</div>
                                    </div>
                                    <img class="pagestaff-steamavatar" src="{{ $user->avatar }}" alt="notfound">
                                </div>
                            @endforeach
                        </div>
                    </div>
            @endforeach
        @endif
    </div>
    @if($setting['servers']['enabled'])
        <div class="container-fluid pageserver" id="pageserver">
            @if($servers > [])
                @if($setting['servers_title']['enabled'])
                    <div class="pageserver-title">
                        <h4 class="display-5 pageglobal-headertitle ph2">{{ $setting['servers_title']['value'] }}</h4>
                        @if($setting['servers_about']['enabled'])
                        <p class="lead pageglobal-headersubtitle ph2">{{ $setting['servers_about']['value'] }}</p>
                        <br>
                        @endif
                    </div>
                @endif
            @endif
            <div class="container">
                <div class="row">
            @foreach($servers as $server)

                            <div class="col-md-6">
                                <a class="sv-joinbtn" href="steam://connect/{{ $server['info']['ip'] . ':' . $server['info']['port'] }}">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    <div>connect</div>
                                </a>
                                <div class="sv-wrapper">
                                    <div class="sv-apptitle">{{ $server['info']['description'] }}</div>
                                    @if($server['info']['name'] == null)
                                        <div class="sv-title">{!! $server['server']['HostName'] !!}</div>
                                    @else
                                        <div class="sv-title">{{$server['info']['name']}}</div>
                                    @endif
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="sv-cnumber">{{ $server['server']['Players'] }}<b> / players</b></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sv-cnumber">{{ $server['server']['MaxPlayers'] }} <b>/ max</b></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="sv-cinfo">{{ $server['info']['ip'] . ':' . $server['info']['port'] }}</div>
                                    <br>
                                </div>
                            </div>
            @endforeach
                </div>
            </div>
        </div>
    @endif
    <footer class="d-flex align-items-center justify-content-center">
        @auth
            @if(Auth::user()->hasAnyRole(['root', 'admin']))
                    <a href="{{ route('dashboard.index') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
            @endif
                <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Sign out</a>
        @endauth
        @guest
                <a href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Sign In</a>
        @endguest
    </footer>
@endsection
    @section('scripts')
        <script src="{{ asset('/js/jquery.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.js') }}"></script>
@endsection