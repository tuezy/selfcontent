<?php

use Illuminate\Http\Request;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions as ConfigurationException;
use Exception as BaseException;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__.'/vendor/autoload_runtime.php';

return function (array $context): void {
    $app =  \Kernel\App::configure(basePath: __DIR__)
        ->withMiddleware(function (Middleware $middleware) {
            //
        })
        ->withExceptions(function (ConfigurationException $exceptions) {
            $exceptions->render(function (BaseException $e, Request $request) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 200);
            });
        })->create();
    $app->useBootstrapPath(storage_path("bootstrap"));
    $app->runningInConsole() ? exit( $app->handleCommand(new ArgvInput)): $app ->handleRequest(Request::capture())
    ;
};