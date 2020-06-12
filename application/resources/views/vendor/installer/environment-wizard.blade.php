@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">
        <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="tabs-wrap">
            @method('POST')
            @csrf
                <div style="display: none;">
                    <input type="text" name="cache_driver" id="cache_driver" value="file" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.cache_placeholder') }}" />
                    <input type="text" name="session_driver" id="session_driver" value="file" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.session_placeholder') }}" />
                    <input type="text" name="queue_driver" id="queue_driver" value="sync" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.queue_placeholder') }}" />
                    <input type="text" name="redis_hostname" id="redis_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_host') }}" />
                    <input type="password" name="redis_password" id="redis_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_password') }}" />
                    <input type="number" name="redis_port" id="redis_port" value="6379" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_port') }}" />
                    <input type="text" name="mail_driver" id="mail_driver" value="smtp" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}" />
                    <input type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}" />
                    <input type="number" name="mail_port" id="mail_port" value="2525" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}" />
                    <input type="text" name="mail_username" id="mail_username" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}" />
                    <input type="text" name="mail_password" id="mail_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}" />
                    <input type="text" name="mail_encryption" id="mail_encryption" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}" />
                    <input type="text" name="pusher_app_id" id="pusher_app_id" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_palceholder') }}" />
                    <input type="text" name="pusher_app_key" id="pusher_app_key" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_palceholder') }}" />
                    <input type="password" name="pusher_app_secret" id="pusher_app_secret" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_palceholder') }}" />
                    <select name="environment" class="form-control form-control-alternative" id="environment" onchange='checkEnvironment(this.value);'>
                        <option value="production">{{ trans('installer_messages.environment.wizard.form.app_environment_label_production') }}</option>
                    </select>
                    <input type="text" name="environment_custom" id="environment_custom" placeholder="{{ trans('installer_messages.environment.wizard.form.app_environment_placeholder_other') }}"/>
                    <input type="radio" name="app_debug" id="app_debug_false" value=false checked />
                    <input type="text" name="broadcast_driver" id="broadcast_driver" value="log" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_placeholder') }}" />
                    <select name="app_log_level" id="app_log_level">
                        <option value="debug" selected>{{ trans('installer_messages.environment.wizard.form.app_log_level_label_debug') }}</option>
                    </select>
                </div>

                <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                    <label for="app_name">Your Community Name</label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-alternative" name="app_name" id="app_name" placeholder="Your Community Name" required />
                    </div>
                    @if ($errors->has('app_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                    <label for="app_url">Url for your website: (example: https://www.google.com)</label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                        </div>
                        <input type="url" name="app_url" id="app_url" class="form-control form-control-alternative" placeholder="Enter the domain of your website." required />
                    </div>
                    @if ($errors->has('app_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                    <label for="database_connection">The installer currently only supports mysql</label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-database"></i></span>
                        </div>
                        <select name="database_connection" class="form-control form-control-alternative" id="database_connection">
                            <option value="mysql" selected>{{ trans('installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                        </select>
                    </div>

                    @if ($errors->has('database_connection'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_connection') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">The domain / ip for mysql to connect to. (typically: localhost)</label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-server"></i></span>
                        </div>
                        <input type="text" name="database_hostname" class="form-control form-control-alternative" id="database_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                    </div>
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('installer_messages.environment.wizard.form.db_port_label') }} (leave this alone if you weren't told to specifically change this)
                    </label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-server"></i></span>
                        </div>
                        <input type="number" name="database_port" class="form-control form-control-alternative" id="database_port" value="3306" placeholder="{{ trans('installer_messages.environment.wizard.form.db_port_placeholder') }}" />
                    </div>
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                    </label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-server"></i></span>
                        </div>
                        <input type="text" name="database_name" class="form-control form-control-alternative" id="database_name" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_name_placeholder') }}" />
                    </div>
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        {{ trans('installer_messages.environment.wizard.form.db_username_label') }}
                    </label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-server"></i></span>
                        </div>
                        <input type="text" name="database_username" class="form-control form-control-alternative" id="database_username" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_username_placeholder') }}" />
                    </div>
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                    </label>
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-server"></i></span>
                        </div>
                        <input type="password" name="database_password" id="database_password" class="form-control form-control-alternative" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                    </div>

                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="card-footer d-flex align-items-center justify-content-center">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                        <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            let element=document.getElementById('environment_text_input');
            if(val === 'other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
    </script>
@endsection
