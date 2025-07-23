<?php

// Vercel entry point for Laravel

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check if the application is already bootstrapped
if (!defined('LARAVEL_BOOTSTRAP_LOADED')) {
    define('LARAVEL_BOOTSTRAP_LOADED', true);
    
    // Register The Auto Loader
    require __DIR__.'/../vendor/autoload.php';
    
    // Bootstrap Laravel
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    $kernel = $app->make(Kernel::class);
    
    $response = $kernel->handle(
        $request = Request::capture()
    )->send();
    
    $kernel->terminate($request, $response);
}
