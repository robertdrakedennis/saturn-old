@extends('layouts.master')
@section('title', 'Update')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light">Check for updates.</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                @if(!$version->isLatestRelease())
                    <div class="alert alert-danger">
                        Your Saturn is not up to date! Your version is <code style="background: rgba(0,0,0,.5); padding: 0.2rem; border-radius: 3px">{{ config('app.version') }}</code>. The latest version is <code style="background: rgba(0,0,0,.5); padding: 0.2rem; border-radius: 3px">{{ $version->getRelease() }}</code>.
                    </div>
                @else
                    <div class="alert alert-success">
                        You're all up to date!
                    </div>
                @endif
            </div>
            <div class="col mt-7">
                @if(!$version->isLatestRelease())
                    <h4 class="text-default text-center">By clicking "update", you'll be updated to {{ $version->getRelease() }}</h4>
                    <form method="POST" action="{{ action('Dashboard\UpdatesController@Update') }}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-block btn-success">Update</button>
                    </form>
                @else
                    <h4 class="text-default text-center">You're on the latest version, we'll let you know when there's a new update.</h4>
                    <button type="submit" class="btn btn-block btn-success disabled">Updates</button>
                @endif
            </div>
            <div class="col mt-7">
                <h4 class="text-default text-center">By clicking "check for updates" you'll forcefully check if any update is available.</h4>
                <form method="POST" action="{{ action('Dashboard\UpdatesController@ForceCheckUpdate') }}">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-block btn-default">Check for Update</button>
                </form>
            </div>
        </div>
    </div>


@endsection