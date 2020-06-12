@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.permissions.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-key fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.permissions.title') }}
@endsection

@section('container')

    <ul class="list-group list-group-flush">
        @foreach($permissions['permissions'] as $permission)
        <li class="list-group-item align-items-center {{ $permission['isSet'] ? 'success' : 'error' }}">
            {{ $permission['folder'] }}
            <span>
                <i class="float-right fas fa-fw fa-{{ $permission['isSet'] ? 'check-circle text-success' : 'exclamation-circle text-danger' }}"></i>
                {{ $permission['permission'] }}
            </span>
        </li>
        @endforeach
    </ul>

    @if ( !isset($permissions['errors']))
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-primary">
                {{ trans('installer_messages.permissions.next') }}
                <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
        @else
        <div class="alert alert-danger">
            You need to fix the following folders by setting their permission to the ones above. You may proceed anyway if you feel this is an error.
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-primary">
                {{ trans('installer_messages.permissions.next') }}
                <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection
