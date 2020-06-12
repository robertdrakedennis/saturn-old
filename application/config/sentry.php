<?php

return array(
    'dsn' => env('SENTRY_LARAVEL_DSN'),

    // capture release as git sha
     'release' => env('app.version'),

    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => false,

    // Capture default user context
    'user_context' => false,
);
