<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Tests;

use Mvdnbrk\Laravel\ActiveAnts\ActiveAntsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelRay\RayServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ActiveAntsServiceProvider::class,
            RayServiceProvider::class,
        ];
    }
}
