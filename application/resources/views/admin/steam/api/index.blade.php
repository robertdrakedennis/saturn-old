@extends('layouts.master')
@section('title', 'Steam Api')
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fab fa-steam font-weight-300"></i> Steam API</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <p>This is where you put in your Steam API key - it's used to allow users to login to the site, to retreive profile data from Steam's servers, and much more. You can find yours <a href="https://steamcommunity.com/dev/apikey" class="font-weight-bold" target="_blank">here</a>!</p>

                        @if($steamApi == null)
                            <div class="alert alert-danger">
                                It looks like your API key is invalid! You should fix this as soon as possible.
                            </div>
                        @endif

                        <form class="mt-4" method="POST" action="{{ action('Dashboard\SteamApiKeyController@Update', $steam) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="steamInput" class="float-left">Steam API Key</label>
                                <input type="password" name="api_key" class="form-control form-control-alternative" id="steamInput" aria-describedby="steamHelp" value="{{ $steam->api_key }}" required>
                                <small><a id="toggle-visibility" href="#!" onclick="togglePassword('steamInput')">Toggle Visibility</a></small>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection