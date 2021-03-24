<?php

namespace Mvdnbrk\Laravel\ActiveAnts\Tests\Endpoints;

use Mvdnbrk\Laravel\ActiveAnts\Endpoints\Status;
use Mvdnbrk\Laravel\ActiveAnts\Tests\TestCase;

class StatusTest extends TestCase
{
    /** @test */
    public function it_can_get_the_status()
    {
        $status = (new Status())->get();

        $this->assertSame('OK', $status['messageCode']);
        $this->assertSame('Status is OK.', $status['message']);
        $this->assertNull($status['result']);
    }
}
