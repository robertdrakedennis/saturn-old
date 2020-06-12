@extends('layouts.master')
@section('title', 'Steam Group')
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fab fa-steam font-weight-300"></i> Steam Group</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="card text-center">
            @if($steamLoadedInfo == null)
                <div class="card-body pt-8">
                    <div class="alert alert-danger">
                        Your steam group is invalid! Please update this as soon as possible!
                    </div>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#steamGroupModal">Update</button>
                    <div class="modal fade" id="steamGroupModal" tabindex="-1" role="dialog" aria-labelledby="steamGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="steamGroupModalLabel">Change Steam Group</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ action('Dashboard\SteamGroupController@Update', $steam) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <i class="fas fa-exclamation-circle my-auto fa-fw fa-2x mx-1"></i>
                                                <p class="mb-0">
                                                    If you need help creating your steam group: use <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=334896308" class="text-white font-weight-bold" target="_blank">this</a> link.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="steamInput" class="float-left">Steam Group Url</label>
                                            <input type="text" name="group_url" class="form-control form-control-alternative" id="steamInput" aria-describedby="steamHelp" placeholder="Enter Group Url" value="{{ $steam->group_url }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <img src="{{ (string) $steamLoadedInfo->groupDetails->avatarFull }}" class="rounded-circle" />
                        </div>
                    </div>
                </div>
                <div class="card-body pt-8">
                    <h2 class="card-title mt-3 mb-0">{{ (string) $steamLoadedInfo->groupDetails->groupName }}</h2>
                    <p>{{ $steamLoadedInfo->groupDetails->membersOnline }}/{{ $steamLoadedInfo->groupDetails->memberCount }} Members Online</p>
                    <div class="my-5">{!!  (string) $steamLoadedInfo->groupDetails->summary !!}</div>
                    <a href="{{ $steam->group_url }}" target="_blank" class="btn btn-secondary">
                        <span class="btn-inner--icon font-weight-300"><i class="fas fa-link"></i></span>
                        <span class="btn-inner--text">View Group</span>
                    </a>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#steamGroupModal">Update</button>
                    <div class="modal fade" id="steamGroupModal" tabindex="-1" role="dialog" aria-labelledby="steamGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="steamGroupModalLabel">Change Steam Group</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ action('Dashboard\SteamGroupController@Update', $steam) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <i class="fas fa-exclamation-circle my-auto fa-fw fa-2x mx-1"></i>
                                                <p class="mb-0">
                                                    Need help with creating a Steam group? Check <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=334896308" class="text-white font-weight-bold" target="_blank">this</a> out!
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="steamInput" class="float-left">Steam Group URL</label>
                                            <input type="text" name="group_url" class="form-control form-control-alternative" id="steamInput" aria-describedby="steamHelp" placeholder="Enter Group Url" value="{{ $steam->group_url }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection