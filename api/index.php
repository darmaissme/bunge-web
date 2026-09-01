<?php

define('LARAVEL_START', microtime(true));

// Prepare /tmp writable storage structure for Vercel Serverless environment
$tmpStorage = '/tmp/storage';
@mkdir("{$tmpStorage}/framework/views", 0755, true);
@mkdir("{$tmpStorage}/framework/cache/data", 0755, true);
@mkdir("{$tmpStorage}/framework/sessions", 0755, true);
@mkdir("{$tmpStorage}/logs", 0755, true);
@mkdir("{$tmpStorage}/app/public", 0755, true);
@mkdir("/tmp/bootstrap/cache", 0755, true);

// Set environment variable overrides for serverless filesystem
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
putenv("APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php");
putenv("APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php");
putenv("APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php");
putenv("APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php");

$_ENV['VIEW_COMPILED_PATH'] = "{$tmpStorage}/framework/views";
$_ENV['APP_CONFIG_CACHE'] = "/tmp/bootstrap/cache/config.php";
$_ENV['APP_SERVICES_CACHE'] = "/tmp/bootstrap/cache/services.php";
$_ENV['APP_PACKAGES_CACHE'] = "/tmp/bootstrap/cache/packages.php";
$_ENV['APP_ROUTES_CACHE'] = "/tmp/bootstrap/cache/routes.php";

// Set fallback APP_KEY if missing in Vercel environment settings
if (empty($_ENV['APP_KEY']) && empty(getenv('APP_KEY'))) {
    putenv('APP_KEY=base64:ASNFZ4mrze8BI0Vniavt7wEjRWeJq+3vASNFZ4mrze8=');
    $_ENV['APP_KEY'] = 'base64:ASNFZ4mrze8BI0Vniavt7wEjRWeJq+3vASNFZ4mrze8=';
}

// Set remote DB credentials fallback if unset or local on Vercel
if (empty($_ENV['DB_HOST']) || $_ENV['DB_HOST'] === 'localhost' || $_ENV['DB_HOST'] === '127.0.0.1') {
    putenv('DB_HOST=liege.id.rapidplex.com');
    $_ENV['DB_HOST'] = 'liege.id.rapidplex.com';
    putenv('DB_DATABASE=eventbun_bunge');
    $_ENV['DB_DATABASE'] = 'eventbun_bunge';
    putenv('DB_USERNAME=eventbun_bungeadmin');
    $_ENV['DB_USERNAME'] = 'eventbun_bungeadmin';
    putenv('DB_PASSWORD=November@202103');
    $_ENV['DB_PASSWORD'] = 'November@202103';
}

// Register Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bind dynamic storage path to Vercel writable /tmp directory
$app->useStoragePath($tmpStorage);

// Handle the HTTP Request
$request = Illuminate\Http\Request::capture();
$app->handleRequest($request);
