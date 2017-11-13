<?php

namespace Tests\Unit\Services\MetaParser;

use Tests\TestCase;
use App\Services\MetaParser\DriverResolver;
use App\Services\MetaParser\Drivers\TedDriver;
use App\Services\MetaParser\Drivers\VimeoDriver;
use App\Services\MetaParser\Drivers\YoutubeDriver;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DriverResolverTest extends TestCase
{
    /** @test */
    public function resolves_a_youtube_driver_from_a_youtube_url()
    {
        $url = 'https://www.youtube.com/watch?v=MF0jFKvS4SI';
        $driver = (new DriverResolver)->getDriverByURL($url);

        $this->assertInstanceOf(YoutubeDriver::class, $driver);
    }

    /** @test */
    public function resolves_a_youtube_driver_from_a_shortened_youtube_url()
    {
        $url = 'https://youtu.be/MF0jFKvS4SI';
        $driver = (new DriverResolver)->getDriverByURL($url);

        $this->assertInstanceOf(YoutubeDriver::class, $driver);
    }

    /** @test */
    public function resolvers_a_vimeo_driver_from_a_vimeo_url()
    {
        $url = 'https://vimeo.com/197536889';
        $driver = (new DriverResolver)->getDriverByURL($url);

        $this->assertInstanceOf(VimeoDriver::class, $driver);
    }

    /** @test */
    public function resolves_a_ted_driver_from_a_ted_url()
    {
        $url = 'https://www.ted.com/talks/james_veitch_the_agony_of_trying_to_unsubscribe';
        $driver = (new DriverResolver)->getDriverByURL($url);

        $this->assertInstanceOf(TedDriver::class, $driver);
    }
}
