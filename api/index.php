<?php

// Forward Vercel requests to Laravel entrypoint
define('LARAVEL_START', microtime(true));

// Setup temporary writable directories for Vercel Serverless environment
$tmpDir = '/tmp';
$_ENV['VIEW_COMPILED_PATH'] = "{$tmpDir}/storage/framework/views";
$_ENV['APP_CONFIG_CACHE'] = "{$tmpDir}/bootstrap/cache/config.php";
$_ENV['APP_SERVICES_CACHE'] = "{$tmpDir}/bootstrap/cache/services.php";
$_ENV['APP_PACKAGES_CACHE'] = "{$tmpDir}/bootstrap/cache/packages.php";
$_ENV['APP_ROUTES_CACHE'] = "{$tmpDir}/bootstrap/cache/routes.php";

putenv("VIEW_COMPILED_PATH={$tmpDir}/storage/framework/views");
putenv("APP_CONFIG_CACHE={$tmpDir}/bootstrap/cache/config.php");
putenv("APP_SERVICES_CACHE={$tmpDir}/bootstrap/cache/services.php");
putenv("APP_PACKAGES_CACHE={$tmpDir}/bootstrap/cache/packages.php");
putenv("APP_ROUTES_CACHE={$tmpDir}/bootstrap/cache/routes.php");

@mkdir("{$tmpDir}/storage/framework/views", 0755, true);
@mkdir("{$tmpDir}/storage/framework/cache/data", 0755, true);
@mkdir("{$tmpDir}/storage/framework/sessions", 0755, true);
@mkdir("{$tmpDir}/bootstrap/cache", 0755, true);

// Register Auto Loader
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request
(require_once __DIR__ . '/../bootstrap/app.php')
    ->handleRequest(\Illuminate\Http\Request::capture());
