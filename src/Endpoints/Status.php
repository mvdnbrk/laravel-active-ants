<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Endpoints;

use Illuminate\Support\Facades\Http;

class Status extends BaseEndpoint
{
    public function get(): array
    {
        return Http::get($this->getApiEndpoint())
            ->throw()
            ->json();
    }

    protected function getApiEndpoint(): string
    {
        return $this->getBaseApiEndpoint().'/status/get';
    }
}
