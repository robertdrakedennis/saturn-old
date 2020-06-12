<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error: 500</title>
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('/img/default/icon.png') }}">

    @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
            Raven.showReportDialog({
                eventId: '{{ Sentry::getLastEventID() }}',
                dsn: 'https://4d85a8e4a6aa42d09a13ef9f575d3114@sentry.io/1292471',
                user: {
                    'name': '',
                    'email': '',
                }
            });
        </script>
    @endif
</head>
<body>
<div class="content" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container h-100 m-auto">
            <div class="d-flex flex-row">
                <img class="m-auto" src="{{ asset('/img/default/logo.svg') }}" style="width: auto; height: 7.5rem;">
                <div class="d-flex flex-column flex-fill">
                    <div class="text-dark">
                        <h1>:( You have an error, <code>please read carefully</code></h1>
                        <h5>Something wen't wrong on our end. Nothing to do with you.</h5>
                        <h5>If you're having any other issues feel free to contact us on discord here:<a href="https://discord.gg/WsNudM9" class="text-dark font-weight-bold"> https://discord.gg/WsNudM9</a></h5>
                        <h5>Please send <code>COPY AND PASTE</code> this ID with your support ticket:</h5>
                        @if(!empty(Sentry::getLastEventID()))
                            <h1 class="text-center"> <code style="background: rgba(0, 0, 0, 0.5); padding: 0.2rem;">{{ Sentry::getLastEventID() }}</code></h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
