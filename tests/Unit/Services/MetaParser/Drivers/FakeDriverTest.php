<?php

namespace Tests\Unit\Services\MetaParser\Drivers;

use Tests\TestCase;
use App\Services\MetaParser\Drivers\FakeDriver;

class FakeDriverTest extends TestCase
{
    /** @test */
    public function returns_metas_from_fake_url()
    {
        $url = 'https://www.example.com/test-video';
        $driver = new FakeDriver;

        $metadata = $driver->parse($url);

        $expected = [
            'url'           => $url,
            'embed_url'     => $url,
            'title'         => '',
            'description'   => '',
            'thumbnail'     => '',
            'width'         => 0,
            'height'        => 0,
            'platform'      => 'fake',
        ];

        $this->assertEquals($expected, $metadata);
    }
}
