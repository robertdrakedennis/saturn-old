@extends('vendor.installer.layouts.master-update')

@section('title', trans('installer_messages.updater.final.title'))
@section('container')
    <p class="paragraph text-center">{{ session('message')['message'] }}</p>
    <div class="d-flex justify-content-center align-items-center">
        <a href="{{ url('/') }}" class="btn btn-primary">{{ trans('installer_messages.updater.final.exit') }}</a>
    </div>
@stop
