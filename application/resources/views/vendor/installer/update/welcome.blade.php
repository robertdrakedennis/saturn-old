@extends('vendor.installer.layouts.master-update')

@section('title', trans('installer_messages.updater.welcome.title'))
@section('container')
    <p class="paragraph text-center">
    	{{ trans('installer_messages.updater.welcome.message') }}
    </p>
    <div class="d-flex justify-content-center align-items-center">
        <a href="{{ route('LaravelUpdater::overview') }}" class="btn btn-primary">{{ trans('installer_messages.next') }}</a>
    </div>
@stop
