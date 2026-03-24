<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Auto-create storage symlink for Render hosting (if not exists)
$storageLink = __DIR__ . '/storage';
$storageTarget = __DIR__ . '/../storage/app/public';

if (!file_exists($storageLink) && file_exists($storageTarget)) {
    @symlink($storageTarget, $storageLink);
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
