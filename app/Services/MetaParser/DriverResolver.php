<?php

namespace App\Services\MetaParser;

use App\Services\MetaParser\Drivers\TedDriver;
use App\Services\MetaParser\Drivers\VimeoDriver;
use App\Services\MetaParser\Drivers\YoutubeDriver;

class DriverResolver implements DriverResolverInterface
{
    protected $drivers = [
        'youtube'   => '/(https\:\/\/www\.youtube\.com\/watch\?v\=.+)|(https\:\/\/youtu.be\/.+)/i',
        'vimeo'     => '/(https\:\/\/vimeo\.com\/.+)/i',
        'ted'       => '/(https\:\/\/www\.ted\.com\/talks\/.+)/i',
    ];

    public function getDriverByURL($url)
    {
        $parser = collect($this->drivers)->filter(function ($pattern) use ($url) {
            return preg_match($pattern, $url);
        });

        if (!$parser->count()) {
            return null;
        }

        return $this->{'get' . ucfirst($parser->keys()->first()) . 'Driver'}();
    }

    protected function getYoutubeDriver()
    {
        return new YoutubeDriver();
    }

    protected function getVimeoDriver()
    {
        return new VimeoDriver();
    }

    protected function getTedDriver()
    {
        return new TedDriver();
    }
}
