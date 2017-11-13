<?php

namespace Tests\Unit\Services\MetaParser\Drivers;

use Tests\TestCase;
use App\Services\MetaParser\Drivers\YoutubeDriver;

class YoutubeDriverTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->expected = [
            'url'           => 'https://www.youtube.com/watch?v=MF0jFKvS4SI',
            'embed_url'     => 'https://www.youtube.com/embed/MF0jFKvS4SI',
            'title'         => '"Cruddy by Design" - Adam Wathan - Laracon US 2017',
            'description'   => 'Thanks to Streamacon for filming! Source code from the presentation can be found here: https://github.com/adamwathan/laracon2017',
            'thumbnail'     => 'https://i.ytimg.com/vi/MF0jFKvS4SI/maxresdefault.jpg',
            'width'         => 1280,
            'height'        => 720,
            'platform'      => 'youtube',
        ];
    }

    /** @test */
    public function returns_metas_from_youtube_url()
    {
        $url = 'https://www.youtube.com/watch?v=MF0jFKvS4SI';
        $driver = new YoutubeDriver;

        $metadata = $driver->parse($url);

        $this->assertEquals($this->expected, $metadata);
    }

    /** @test */
    public function returns_metas_from_shortened_youtube_url()
    {
        $url = 'https://youtu.be/MF0jFKvS4SI';
        $driver = new YoutubeDriver;

        $metadata = $driver->parse($url);

        $this->assertEquals($this->expected, $metadata);
    }
}
