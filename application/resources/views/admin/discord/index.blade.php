@extends('layouts.master')
@section('title', 'Discord')
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-white"><i class="fab fa-discord font-weight-300"></i> Discord</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="card text-center shadow-xl">
            <div class="card-body">
                <h2 class="card-title">{{ $name }}</h2>
                <div class="icon-shape icon-lg bg-primary text-white rounded-circle shadow my-2" style="height: 4.5rem; width: 4.5rem;">
                    <i class="fab fa-discord fa-fw fa-3x"></i>
               </div>
                <p class="card-text">Online Members: {{ $onlineMembers }}</p>


                <a href="{{ $invite }}" target="_blank" class="btn btn-secondary">
                    <span class="btn-inner--icon font-weight-300"><i class="fas fa-link"></i></span>
                    <span class="btn-inner--text">Test Invite Link</span>
                </a>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#discordModal">Update</button>
                <div class="modal fade" id="discordModal" tabindex="-1" role="dialog" aria-labelledby="discordModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="discordModalLabel">Change Discord Servers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" role="form" action="{{ action('Dashboard\DiscordController@Update', $discordId) }}">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="alert alert-warning">
                                        <div class="d-flex flex-row justify-content-center align-items-center">
                                            <i class="fas fa-exclamation-circle my-auto fa-fw fa-1x mx-1"></i>
                                            <p class="mb-0">
                                                If you need help finding your server id: use <a href="https://support.discordapp.com/hc/en-us/articles/206346498-Where-can-I-find-my-User-Server-Message-ID-" class="text-white font-weight-bold" target="_blank">this</a> help document.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discordInput" class="text-left float-left">Discord ID</label>
                                        <input type="text" name="server_id" class="form-control form-control-alternative" id="discordInput" aria-describedby="discordHelp" placeholder="Enter Discord Server ID" value="{{ $discordId->server_id }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection