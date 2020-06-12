@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.menu.title') !!}
@endsection

@section('container')

    <div class="alert alert-danger">
        <span class="font-weight-bold">Please note:</span> you need to have your MYSQL information ready. If you need help figuring out what this is, open a ticket.
    </div>
    <p class="text-center">
        {!! trans('installer_messages.environment.menu.desc') !!}
    </p>
    <div class="d-flex justify-content-center align-items-center">
        <a href="{{ route('LaravelInstaller::environmentWizard') }}" class="btn btn-primary">
            <i class="fas fa-magic fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.menu.wizard-button') }}
        </a>
    </div>

@endsection
