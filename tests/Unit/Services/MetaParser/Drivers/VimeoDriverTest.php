<?php

namespace Tests\Unit\Services\MetaParser\Drivers;

use Tests\TestCase;
use App\Services\MetaParser\Drivers\VimeoDriver;

class VimeoDriverTest extends TestCase
{
    /** @test */
    public function returns_metas_from_vimeo_url()
    {
        $url = 'https://vimeo.com/197536889';
        $driver = new VimeoDriver;

        $metadata = $driver->parse($url);

        $expected = [
            'url'           => $url,
            'embed_url'     => 'https://player.vimeo.com/video/197536889?autoplay=1',
            'title'         => 'Don\'t Mock What You Don\'t Own',
            'description'   => 'This lesson is part of the "Test-Driven Laravel" course I recently launched.  If you\'ve ever wanted to learn how to TDD a real-world app from start…',
            'thumbnail'     => 'https://i.vimeocdn.com/video/610289457_1280x720.jpg',
            'width'         => 1280,
            'height'        => 720,
            'platform'      => 'vimeo',
        ];

        $this->assertEquals($expected, $metadata);
    }
}
