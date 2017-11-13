<?php

namespace Tests\Unit\Services\MetaParser;

use Tests\TestCase;
use App\Services\MetaParser\Drivers\FakeDriver;
use App\Services\MetaParser\FakeDriverResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FakeDriverResolverTest extends TestCase
{
    /** @test */
    public function resolves_a_fake_driver_from_any_url()
    {
        $url = 'https://www.example.com/test-video';
        $driver = (new FakeDriverResolver)->getDriverByURL($url);

        $this->assertInstanceOf(FakeDriver::class, $driver);
    }
}
