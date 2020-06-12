@if(!$version->isLatestRelease())
    <div class="position-fixed mx-5" style="z-index: 9999; bottom: 0; right: 0;">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation"></i> Your Saturn is not up to date! Your version is <code style="background: rgba(0,0,0,.5); padding: 0.2rem; border-radius: 3px">{{ config('app.version') }}</code>. The latest version is <code style="background: rgba(0,0,0,.5); padding: 0.2rem; border-radius: 3px">{{ $version->getRelease() }}</code>.
        </div>
    </div>
@endif