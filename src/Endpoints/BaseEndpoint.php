<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Endpoints;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

abstract class BaseEndpoint
{
    protected function getBaseApiEndpoint(): string
    {
        return Str::of('https://shopapi.activeants.nl')
            ->when($this->useTestEnvironment(), fn (Stringable $string) => $string->replace('.activeants.nl', 'test.activeants.nl'))
            ->__toString();
    }

    protected function getApiEndpoint(): string
    {
        return Str::of($this->getBaseApiEndpoint())
            ->append('/')
            ->append(Str::kebab(class_basename($this)))
            ->__toString();
    }

    private function useTestEnvironment(): bool
    {
        return app()->isProduction() === false;
    }
}
