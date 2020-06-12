<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="twitter:card" content="summary" />
    @if($setting['meta_logo']['enabled'])
        <link rel="icon" href="{{ $setting['meta_logo']['value'] }}" />
    @endif
    @if($setting['meta_site_name']['enabled'])
        <meta property="og:site_name" content="{{ $setting['meta_site_name']['value'] }}"/>
    @endif
    @if($setting['meta_title']['enabled'])
        <meta property="og:title" content="{{ $setting['meta_title']['value'] }}"/>
    @endif
    @if($setting['meta_description']['enabled'])
        <meta property="og:description" content="{{ $setting['meta_description']['value'] }}"/>
    @endif
    <meta property="og:type" content="Product">
    @if($setting['meta_image']['enabled'])
        <meta property="og:image" content="{{ $setting['meta_image']['value'] }}"/>
    @endif

    @if($setting['twitter_card']['enabled'])
        @if($setting['twitter_title']['enabled'])
            <meta property="twitter:title" content="{{ $setting['twitter_title']['value'] }}" />
        @endif

        @if($setting['twitter_site']['enabled'])
            <meta property="twitter:site" content="{{ $setting['twitter_site']['value'] }}" />
        @endif

        @if($setting['twitter_description']['enabled'])
            <meta property="twitter:description" content="{{ $setting['twitter_description']['value'] }}" />
        @endif
        @if($setting['twitter_image']['enabled'])
            <meta property="twitter:image" content="{{ $setting['twitter_image']['value'] }}" />
        @endif
    @endif

    <title>{{ $setting['site_name']['value'] ?? env('APP_NAME') }} </title>
    @yield('styles')
</head>
<body class="@yield('bodyClasses')">
@yield('content')
@yield('scripts')
</body>
</html>
