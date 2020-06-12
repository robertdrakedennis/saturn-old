@extends('layouts.master')
@section('title', 'Settings')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-12">
                    <h1 class="header text-light"><i class="fas fa-cogs"></i> Editing Settings</h1>
                    <form method="POST" class="form-inline w-100 my-2" action="{{ action('Dashboard\SettingsController@Search') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group mx-1 flex-fill">
                            <input type="text" name="search" id="search" class="flex-fill form-control form-control-alternative">
                            <label for="search"></label>
                        </div>
                        <button type="submit" class="btn btn-success mx-1">
                            <span class="btn-inner--icon font-weight-300"><i class="fas fa-search"></i></span>
                            <span class="btn-inner--text">Search</span>
                        </button>
                    </form>
                    <div class="alert alert-warning">
                      <i class="fas fa-question fa-fw fa-1x"></i> Can't find a setting? Too many settings to go through? <code style="background: rgba(0,0,0,.5); padding: 0.25rem; border-radius: 3px;">(Example: Site, Steam Group, Steam, Discord, etc.)</code>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                <div class="card-deck">
                    @foreach($settings as $setting)
                        <div class="card m-3" style="-ms-flex-preferred-size: 410px!important;    flex-basis: 410px!important;">
                            <form class="d-flex flex-column h-100" method="POST" action="{{ action('Dashboard\SettingsController@Update', $setting) }}">
                                @csrf
                                @method('PATCH')
                                @if ($setting->value === null && $setting->enabled !== null)
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="{{ $setting->title }}ControlSelect1">{{ $setting->pretty_title }}</label>
                                            <select class="form-control form-control-alternative" name="enabled" id="{{ $setting->title }}ControlSelect1">
                                                <option value="0" @if($setting->enabled == 0) selected @endif>Disabled</option>
                                                <option value="1" @if($setting->enabled == 1) selected @endif>Enabled</option>
                                            </select>
                                        </div>
                                    </div>

                                @elseif($setting->value !== null && $setting->enabled === null)
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="{{ $setting->title }}Input">{{ $setting->pretty_title }}</label>
                                                <input type="text" class="form-control form-control-alternative" name="value" id="{{ $setting->title }}Input" aria-describedby="{{ $setting->title }}Help" value="{{ $setting->value }}">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="{{ $setting->title }}Input">{{ $setting->pretty_title }}</label>
                                                <input type="text" class="form-control form-control-alternative" name="value" id="{{ $setting->title }}Input" aria-describedby="{{ $setting->title }}Help" value="{{ $setting->value }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="{{ $setting->title }}ControlSelect1">{{ $setting->pretty_title }}</label>
                                            <select class="form-control form-control-alternative" name="enabled" id="{{ $setting->title }}ControlSelect1">
                                                <option value="0" @if($setting->enabled == 0) selected @endif>Disabled</option>
                                                <option value="1" @if($setting->enabled == 1) selected @endif>Enabled</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update {{ $setting->pretty_title }}</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
                {{ $settings->links() }}
            </div>
        </div>
    </div>
@endsection
