@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.requirements.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.requirements.title') }}
@endsection

@section('container')
    @foreach($requirements['requirements'] as $type => $requirement)
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
                <strong>{{ ucfirst($type) }}</strong>
                @if($type == 'php')
                    <strong>
                        <small>
                            (version {{ $phpSupportInfo['minimum'] }} required)
                        </small>
                    </strong>
                    <span class="float-right d-flex flex-row">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <i class="my-auto ml-1 float-right fas fa-fw fa-{{ $phpSupportInfo['supported'] ? 'check-circle' . ' text-success' : 'exclamation-circle' . ' text-danger' }} row-icon" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
            @foreach($requirements['requirements'][$type] as $extention => $enabled)
                <li class="list-group-item {{ $enabled ? 'success' : 'error' }}">
                    {{ $extention }}
                    <i class="float-right fas fa-fw fa-{{ $enabled ? 'check-circle' . ' text-success' : 'exclamation-circle' . ' text-danger' }} row-icon" aria-hidden="true"></i>
                </li>
            @endforeach
        </ul>
    @endforeach

    @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] )
        <div class="d-flex justify-content-center align-items-center my-4">
            <a class="btn btn-primary" href="{{ route('LaravelInstaller::permissions') }}">
                {{ trans('installer_messages.requirements.next') }}
                <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection