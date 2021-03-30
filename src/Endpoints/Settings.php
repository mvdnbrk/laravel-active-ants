<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Endpoints;

use Illuminate\Support\Facades\Http;

class Settings extends BaseEndpoint
{
    public function get(): array
    {
        $token = (new Authentication())->token();

        return Http::withToken($token)
            ->get($this->getApiEndpoint())
            ->throw()
            ->json();
    }

    protected function getApiEndpoint(): string
    {
        return $this->getBaseApiEndpoint().'/settings/get';
    }
}
