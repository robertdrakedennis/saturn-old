@extends('vendor.installer.layouts.master-update')

@section('title', trans('installer_messages.updater.welcome.title'))
@section('container')
    <p class="paragraph text-center">{{ trans_choice('installer_messages.updater.overview.message', $numberOfUpdatesPending, ['number' => $numberOfUpdatesPending]) }}</p>
    <div class="d-flex align-items-center justify-content-center">
        <a href="{{ route('LaravelUpdater::database') }}" class="btn btn-primary">{{ trans('installer_messages.updater.overview.install_updates') }}</a>
    </div>
@stop
