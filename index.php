<?php

use Illuminate\Http\Request;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions as ConfigurationException;
use Exception as BaseException;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__.'/vendor/autoload_runtime.php';

return function (array $context): void {
    $app =  \Kernel\App::init($context)
        ->create()
        ->useBootstrapPath(storage_path("bootstrap"));
    $app->runningInConsole() ? exit( $app->handleCommand(new ArgvInput)): $app ->handleRequest(Request::capture());
};