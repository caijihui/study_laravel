<?php

return array(
    'dsn' => env('SENTRY_LARAVEL_DSN','https://0a9297f7d73a4fd992a1d1b1c0ac59f5@sentry.io/1376416'),

    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => true,

    // Capture default user context
    'user_context' => false,
);
