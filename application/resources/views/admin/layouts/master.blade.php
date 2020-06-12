@inject('setting', 'App\Services\Helpers\SettingsService')
@inject('version', 'App\Services\Update\SoftwareVersionService')

        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->settings()['site_name']['value'] ?? env('APP_NAME') }} - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="twitter:card" content="summary" />
    @if($setting->settings()['meta_title']['enabled'])
        <meta property=”og:title” content=”{{ $setting->settings()['meta_title']['value'] }}”/>
    @endif
    @if($setting->settings()['meta_image']['enabled'])
        <meta property=”og:image” content=”{{ $setting->settings()['meta_image']['value'] }}”/>
    @endif

    @if($setting->settings()['site_name']['enabled'])
        <meta property=”og:site_name” content=”{{ $setting->settings()['site_name']['value'] }}”/>
    @endif

    @if($setting->settings()['site_name']['enabled'])
        <meta property=”og:description” content=”{{ $setting->settings()['site_name']['value'] }}”/>
    @endif

    @if($setting->settings()['twitter_site']['enabled'])
        <meta property="twitter:site" content="{{ $setting->settings()['twitter_site']['value'] }}" />
    @endif

    @if($setting->settings()['twitter_card']['enabled'])
        @if($setting->settings()['twitter_title']['enabled'])
            <meta property="twitter:title" content="{{ $setting->settings()['twitter_title']['value'] }}" />
        @endif

        @if($setting->settings()['twitter_description']['enabled'])
            <meta property="twitter:description" content="{{ $setting->settings()['twitter_description']['value'] }}" />
        @endif
        @if($setting->settings()['twitter_image']['enabled'])
            <meta property="twitter:image" content="{{ $setting->settings()['twitter_image']['value'] }}" />
        @endif
    @endif
    <link href="{{ asset('/css/argon.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/fa.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/swal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/spectrum.css') }}" rel="stylesheet">
    @yield('extraStyles')
</head>
<body>
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <h6 class="navbar-heading text-muted">Main Options</h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.index') ?: 'active' }}" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-fw fa-home text-blue"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.links') ?: 'active' }}" href="{{ route('dashboard.links') }}">
                        <i class="fas fa-fw fa-link text-info"></i> Links
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.features') ?: 'active' }}" href="{{ route('dashboard.features') }}">
                        <i class="fas fa-fw fa-fire text-danger"></i> Features
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.team') ?: 'active' }}" href="{{ route('dashboard.team') }}">
                        <i class="fas fa-fw fa-user-astronaut text-warning"></i> Teams
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.servers') ?: 'active' }}" href="{{ route('dashboard.servers') }}">
                        <i class="fas fa-fw fa-server text-yellow"></i> Servers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.discord') ?: 'active' }}" href="{{ route('dashboard.discord') }}">
                        <i class="fab fa-fw fa-discord text-pink"></i> Discord
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.themes') ?: 'active' }}" href="{{ route('dashboard.themes') }}">
                        <i class="fas fa-fw fa-paint-roller text-purple"></i> Themes
                    </a>
                </li>
            </ul>

            <hr class="my-3">

            <h6 class="navbar-heading text-muted">Misc Options</h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.users') ?: 'active' }}" href="{{ route('dashboard.users') }}">
                        <i class="fas fa-fw fa-users-cog text-default"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.steam.api') ?: 'active' }}" href="{{ route('dashboard.steam.api') }}">
                        <i class="fab fa-fw fa-steam text-default"></i> Steam API Key
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.steam.group') ?: 'active' }}" href="{{ route('dashboard.steam.group') }}">
                        <i class="fab fa-fw fa-steam text-default"></i> Steam Group ID
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.settings.index') ?: 'active' }}" href="{{ route('dashboard.settings.index') }}">
                        <i class="fas fa-fw fa-cogs text-default"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !starts_with(Route::currentRouteName(), 'dashboard.update') ?: 'active' }}" href="{{ route('dashboard.update') }}">
                        <i class="fas fa-fw fa-download text-default"></i> Update  @if(!$version->isLatestRelease())  <span class="badge badge-success">Update Available</span> @endif
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="main-content">
    @include('admin.partials.update.update')
    <nav class="navbar navbar-top navbar-expand-md navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('dashboard.index') }}">{{$setting->settings()['site_name']['value'] ?? env('APP_NAME') }}</a>
            <ul class="navbar-nav px-3">
                @auth
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i> Front Page</a>
                    </li>
                    <li class="nav-item text-nowrap">
                        <form class="form-inline" method="POST" action="{{ route('dashboard.cache') }}">
                            @csrf
                            @method('POST')
                            <button type="submit" style="background: none; border: 0;" class="nav-link" href="{{ route('index') }}"><i class="fas fa-sync-alt"></i> Clear Cache</button>
                        </form>
                    </li>
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Sign out</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    @yield('content')
</div>


<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.js') }}"></script>
<script src="{{ asset('/js/argon.js') }}"></script>
<script src="{{ asset('/js/swal.js') }}"></script>
<script src="{{ asset('/js/spectrum.js') }}"></script>
@yield('extraScripts')
@include('sweetalert::alert')
</body>
</html>