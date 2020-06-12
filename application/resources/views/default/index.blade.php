@extends('layouts.master')
@section('styles')
    <link href="{{ asset('/css/fa.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/argon.css') }}" rel="stylesheet">
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
        <header class="header bg-gradient-primary header-overlay py-7 py-lg-8" @if($setting['background_image']['enabled']) style="background: url('{{ $setting['background_image']['value'] }}') no-repeat center !important; background-attachment: fixed; -webkit-background-size: cover!important;background-size: cover!important;" @endif>
            <div class="container position-relative">
                <div class="header-body text-center mb-7">
                    <div class="p-4 my-7 text-center">
                        @if($setting['site_logo']['enabled'])
                            <img src="{{ $setting['site_logo']['value'] }}" class="img-fluid logo mt-0" style="height: 10.5rem; width: 10.5rem;margin-top: -100px !important;">
                        @endif
                        <h1 class="display-4 text-light">{{ $setting['site_name']['value'] }}</h1>
                        <p class="lead text-light">{{ $setting['site_about']['value'] }}</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-xs-column flex-sm-column flex-md-column flex-lg-row flex-xl-row">
                        @foreach($links as $link)
                            <a @if($link->new_tab) target="_blank" @endif
                                href="{{ $link->url }}" target="_blank" class="btn btn-primary mx-sm-0 mx-md-2 mx-lg-3 mx-xl-3 my-sm-2 my-md-2 my-lg-1 my-xl-1"><i class="{{ $link->fa_icon }}"></i> {{ $link->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </header>
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                @if($features->count() > 0)
                    @if($setting['features']['enabled'])
                        <div class="col-12">
                            @if($setting['features_title']['enabled'])
                                <div class="jumbotron bg-white shadow-lg text-center">
                                    <h1 class="display-4">{{ $setting['features_title']['value'] }}</h1>
                                    @if($setting['features_about']['enabled'])
                                        <p class="lead">{{ $setting['features_about']['value'] }}</p>
                                    @endif
                                </div>
                            @endif
                            @endif
                            <div class="card-deck">
                                @foreach($features as $feature)
                                    <div class="card shadow shadow-lg--hover text-center" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                        @if($feature->display == 'image')
                                            <img class="card-img-top" src="{{ $feature->img_url }}">
                                        @endif
                                        <div class="card-body">
                                            <h2 class="card-title">{{$feature->title}}</h2>
                                            @if($feature->display == 'fontawesome')
                                                <div class="icon-shape icon-lg text-white rounded-circle shadow my-2" style="height: 4.5rem; width: 4.5rem; background-color: {{ $feature->fa_color }};">
                                                    <i class="{{ $feature->fa_icon }} fa-fw fa-6x py-2"></i>
                                                </div>
                                            @endif
                                            <p class="card-text mb-0">{{ $feature->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($setting['teams']['enabled'])
                        <div class="col-12 my-4">
                            @if($teams->count() > 0)
                                @if($setting['teams_title']['enabled'])
                                    <div class="jumbotron bg-white shadow-lg text-center">
                                        <h1 class="display-4">{{ $setting['teams_title']['value'] }}</h1>
                                        @if($setting['teams_about']['enabled'])
                                            <p class="lead">{{ $setting['teams_about']['value'] }}</p>
                                        @endif
                                        @endif
                                    </div>
                                @endif
                                <div class="card-deck">
                                    @foreach($teams as $team)
                                      @if($team->users->count() > 0)
                                            <div class="card shadow shadow-lg--hover text-center" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                                @if($team->display == 'image')
                                                    <img class="card-img-top" src="{{ $team->img_url }}">
                                                @endif
                                                <div class="card-body">
                                                    <h2 class="card-title">{{$team->name}}</h2>
                                                    @if($team->display == 'fontawesome')
                                                        <div class="icon-shape icon-lg text-white rounded-circle shadow my-2" style="height: 4.5rem; width: 4.5rem; background-color: {{ $team->fa_color }};">
                                                            <i class="{{ $team->fa_icon }} fa-fw fa-6x py-2"></i>
                                                        </div>
                                                    @endif
                                                    <p class="card-text">{{ $team->description }}</p>
                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                @foreach($team->users->take(3) as $user)
                                                                    <div class="d-flex flex-column mx-3">
                                                                        <img src="{{ $user->avatar }}" style="height: 4.5rem; width: 4.5rem; border-radius: 100vh;">
                                                                        <h4>{{ $user->name }}</h4>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @if($team->users->count() > 3)
                                                                <div class="card-footer">
                                                                    <button type="button" data-toggle="modal" data-target="#staffMembers{{$team->id}}" class="btn btn-primary">View all members</button>
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
                                                                                            <div class="card text-center my-3 border-0" style="-ms-flex-preferred-size: 110px!important;    flex-basis: 110px!important;">
                                                                                                <div class="card-body">
                                                                                                    <div class="d-flex flex-column mx-3 justify-content-center align-items-center">
                                                                                                        <img src="{{ $user->avatar }}" style="height: 4.5rem; width: 4.5rem; border-radius: 100vh;">
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
                        </div>
                    @endif
                    @if($setting['servers']['enabled'])
                        <div class="col-12 my-4">
                            @if($servers > [])
                                @if($setting['servers_title']['enabled'])
                                    <div class="jumbotron bg-white shadow-lg text-center">
                                        <h1 class="display-4">{{ $setting['servers_title']['value'] }}</h1>
                                        @if($setting['servers_about']['enabled'])
                                            <p class="lead">{{ $setting['servers_about']['value'] }}</p>
                                        @endif
                                    </div>
                                @endif
                            @endif
                            <div class="card-deck">
                                @foreach($servers as $server)
                                    <div class="card shadow shadow-lg--hover text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                        @if($server['info']['display'] == 'image')
                                            <img class="card-img-top" src="{{ $server['info']['img_url'] }}">
                                        @endif
                                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                            @if($server['info']['name'] == null)
                                                <h2 class="card-title">{!! $server['server']['HostName'] !!}</h2>
                                            @else
                                                <h2 class="card-title">{{$server['info']['name']}}</h2>
                                            @endif
                                            @if($server['info']['display'] == 'fontawesome')
                                                <div class="icon-shape icon-lg text-white rounded-circle shadow my-2" style="height: 4.5rem; width: 4.5rem; background-color: {{ $server['info']['fa_color'] }};">
                                                    <i class="{{ $server['info']['fa_icon'] }} fa-fw fa-6x py-2"></i>
                                                </div>
                                            @endif
                                            <p class="card-text">{{ $server['info']['description'] }}</p>
                                            <p>Players: {{ $server['server']['Players'] }}/{{ $server['server']['MaxPlayers'] }}</p>
                                            <a href="steam://connect/{{ $server['info']['ip'] . ':' . $server['info']['port'] }}">Connect</a>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($setting['discord']['enabled'])
                        <div class="col-12 my-4">
                            @if($setting['discord_title']['enabled'])
                                <div class="jumbotron bg-white shadow text-center">
                                    <h1 class="display-4">{{  $setting['discord_title']['value'] }}</h1>
                                    @if($setting['discord_about']['enabled'])
                                        <p class="lead">{{  $setting['discord_about']['value'] }}</p>
                                    @endif
                                </div>
                            @endif
                            <div class="card-deck">
                                <div class="card shadow shadow-lg--hover text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                    <div class="card-body justify-content-center align-items-center text-center">
                                        <h3>{{ $discord->name }}</h3>
                                        <div class="icon-shape icon-lg bg-primary text-white rounded-circle shadow my-2" style="height: 4.5rem; width: 4.5rem;">
                                            <i class="fab fa-discord fa-fw fa-6x"></i>
                                        </div>
                                        <p class="h2 mb-0">{{ count($discord->members) }}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ $discord->instant_invite }}" class="btn btn-primary">Join Our Discord</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($setting['steam_group']['enabled'])
                        <div class="col-12 my-4">
                            @if( $setting['steam_group_title']['enabled'])
                                <div class="jumbotron bg-white shadow  text-center">
                                    <h1 class="display-4">{{  $setting['steam_group_title']['value'] }}</h1>
                                    @if( $setting['steam_group_about']['enabled'])
                                        <p class="lead">{{  $setting['steam_group_about']['value'] }}</p>
                                    @endif
                                </div>
                            @endif
                            <div class="card-deck">
                                <div class="card shadow shadow-lg--hover text-center my-3" style="-ms-flex-preferred-size: 310px!important;    flex-basis: 310px!important;">
                                    <div class="card-body justify-content-center align-items-center text-center">
                                        <h3> {{ (string) $steamLoadedInfo->groupDetails->groupName }}</h3>
                                        <img src="{{ (string) $steamLoadedInfo->groupDetails->avatarFull }}" style="height: 4.5rem; width: 4.5rem; -webkit-border-radius: 100vh;-moz-border-radius: 100vh;border-radius: 100vh;">
                                    </div>
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item">Members Online: {{ $steamLoadedInfo->groupDetails->membersOnline . ' / ' . $steamLoadedInfo->groupDetails->memberCount }}</li>
                                        <li class="list-group-item">Members in chat: {{ $steamLoadedInfo->groupDetails->membersInChat }}</li>
                                    </ul>
                                    <div class="card-body text-center">
                                        <h3>About</h3>
                                        <p>
                                            {{ (string) $steamLoadedInfo->groupDetails->summary }}
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ $steam->group_url }}" class="btn btn-primary">Join Steam Group</a>
                                    </div>
                                </div>
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
