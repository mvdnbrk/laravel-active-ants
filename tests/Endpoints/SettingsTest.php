<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Tests\Endpoints;

use Mvdnbrk\Laravel\ActiveAnts\Endpoints\Settings;
use Mvdnbrk\Laravel\ActiveAnts\Tests\TestCase;

class SettingsTest extends TestCase
{
    /** @test */
    public function it_can_get_the_settings()
    {
        $settings = (new Settings())->get();

        $this->assertSame('OK', $settings['messageCode']);
        $this->assertSame('Settings are ok.', $settings['message']);
        $this->assertIsArray($settings['result']);
    }
}
