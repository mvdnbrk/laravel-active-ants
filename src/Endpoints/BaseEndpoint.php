<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Endpoints;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

abstract class BaseEndpoint
{
    protected string $token;

    public function __construct()
    {
        $this->token = (new Authentication)->token();
    }

    protected function getApiEndpoint(): string
    {
        return Str::of('https://shopapi.activeants.nl')
            ->when($this->useDemoEnvironment(), fn (Stringable $string) => $string->replace('.activeants.nl', 'test.activeants.nl'))
            ->append('/')
            ->append(Str::kebab(class_basename($this)))
            ->__toString();
    }

    private function useDemoEnvironment(): bool
    {
        return app()->isProduction() === false;
    }
}
