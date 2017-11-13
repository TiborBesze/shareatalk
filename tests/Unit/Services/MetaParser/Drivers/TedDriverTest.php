<?php

namespace Tests\Unit\Services\MetaParser\Drivers;

use Tests\TestCase;
use App\Services\MetaParser\Drivers\TedDriver;

class TedDriverTest extends TestCase
{
    /** @test */
    public function returns_metas_from_ted_url()
    {
        $url = 'https://www.ted.com/talks/james_veitch_the_agony_of_trying_to_unsubscribe';
        $driver = new TedDriver;

        $metadata = $driver->parse($url);

        $expected = [
            'url'           => $url,
            'embed_url'     => $url,
            'title'         => 'The agony of trying to unsubscribe',
            'description'   => 'It happens to all of us: you unsubscribe from an unwanted marketing email, and a few days later another message from the same company pops up in your inbox. Comedian James Veitch turned this frustration into whimsy when a local supermarket refused to take no for an answer. Hijinks ensued.',
            'thumbnail'     => 'https://pi.tedcdn.com/r/pe.tedcdn.com/images/ted/a071a87107bdf04eb17ab834903ec11afaa39404_2880x1620.jpg?c=1050%2C550&w=1050',
            'width'         => 1280,
            'height'        => 720,
            'platform'      => 'ted',
        ];

        $this->assertEquals($expected, $metadata);
    }
}
