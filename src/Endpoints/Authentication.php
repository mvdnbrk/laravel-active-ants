<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Endpoints;

use Illuminate\Support\Facades\Http;

class Authentication extends BaseEndpoint
{
    public function token(): string
    {
        return cache()->get(
            $this->accessTokenCacheKey(),
            fn () => $this->cacheToken()
        );
    }

    private function cacheToken(): string
    {
        $value = $this->requestToken();
        $token = data_get($value, 'access_token');

        cache()->put($this->accessTokenCacheKey(), $token, data_get($value, 'expires_in'));

        return $token;
    }

    private function requestToken(): array
    {
        return Http::withBasicAuth(config('activeants.username'), config('activeants.password'))
            ->post($this->getApiEndpoint())
            ->throw()
            ->json();
    }

    private function getApiEndpoint(): string
    {
        return $this->getBaseApiEndpoint().'/token';
    }

    private function accessTokenCacheKey(): string
    {
        return 'mvdnbrk.laravel.activeants.access_token';
    }
}
