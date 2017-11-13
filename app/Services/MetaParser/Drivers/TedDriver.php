<?php

namespace App\Services\MetaParser\Drivers;

class TedDriver implements DriverInterface
{
    use FetchesURL, LoadsHTML;

    public function parse($url)
    {
        $html = $this->fetch($url);

        if (!$html) {
            return false;
        }

        $document = $this->load($html);

        $this->loadMetas($document);

        return [
            'url'           => $this->og('url'),
            'embed_url'     => $this->og('url'),
            'title'         => $this->og('title'),
            'description'   => $this->og('description'),
            'thumbnail'     => $this->og('image'),
            'width'         => 1280,
            'height'        => 720,
            'platform'      => 'ted',
        ];
    }
}
