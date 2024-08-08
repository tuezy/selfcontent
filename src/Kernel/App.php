<?php
namespace Kernel;
use Illuminate\Foundation\Application;

class App extends Application{

    public static function configure(?string $basePath = null)
    {
        $basePath = match (true) {
            is_string($basePath) => $basePath,
            default => static::inferBasePath(),
        };
        return (new Configuration(new static($basePath)))
            ->withKernels()
            ->withEvents()
            ->withCommands()
            ->withProviders();
    }

    public function getNamespace()
    {
        return "App";
    }
}