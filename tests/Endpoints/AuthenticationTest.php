<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Tests\Endpoints;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Mvdnbrk\Laravel\ActiveAnts\Endpoints\Authentication;
use Mvdnbrk\Laravel\ActiveAnts\Tests\TestCase;

class AuthenticationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        cache()->forget('mvdnbrk.laravel.activeants.access_token');
    }

    protected function tearDown(): void
    {
        cache()->forget('mvdnbrk.laravel.activeants.access_token');

        parent::tearDown();
    }

    private function accessTokenCacheKey(): string
    {
        return 'mvdnbrk.laravel.activeants.access_token';
    }

    /** @test */
    public function it_can_obtain_an_access_token()
    {
        Http::fake([
            'shopapitest.activeants.nl/*' => Http::response([
                'access_token' => '123456',
                'expires_in' => 299,
            ], Response::HTTP_OK),
        ]);

        $token = (new Authentication())->token();

        $this->assertSame('123456', $token);
        $this->assertTrue(cache()->has($this->accessTokenCacheKey()));
        $this->assertSame('123456', cache()->get($this->accessTokenCacheKey()));
    }

    /** @test */
    public function it_throws_an_exception_when_providing_bad_credentials()
    {
        Http::fake([
            'login.bol.com/*' => Http::response([
                'error' => 'unauthorized',
                'error_description' => 'Bad credentials',
            ], Response::HTTP_UNAUTHORIZED),
        ]);

        try {
            (new Authentication())->token();
        } catch (RequestException $e) {
            $this->assertStringContainsString('HTTP request returned status code 401', $e->getMessage());
            $this->assertTrue(cache()->missing($this->accessTokenCacheKey()));

            return;
        }

        $this->fail('Request exception was not thrown.');
    }
}
