<?php

namespace Mvdnbrk\Laravel\ActiveAnts;

use Illuminate\Support\ServiceProvider;

class ActiveAntsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPublishing();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/activeants.php', 'activeants');
    }

    private function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/activeants.php' => config_path('activeants.php'),
            ], 'activeants-config');
        }
    }
}
