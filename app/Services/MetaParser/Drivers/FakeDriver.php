<?php

namespace App\Services\MetaParser\Drivers;

class FakeDriver implements DriverInterface
{
    public function parse($url)
    {
        return [
            'url'           => $url,
            'embed_url'     => $url,
            'title'         => '',
            'description'   => '',
            'thumbnail'     => '',
            'width'         => 0,
            'height'        => 0,
            'platform'      => 'fake',
        ];
    }
}
