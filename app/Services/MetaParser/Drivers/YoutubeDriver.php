<?php

namespace App\Services\MetaParser\Drivers;

use App\Services\MetaParser\Traits\LoadsHTML;
use App\Services\MetaParser\Traits\FetchesURL;

class YoutubeDriver implements DriverInterface
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
            'embed_url'     => $this->og('video:secure_url'),
            'title'         => $this->og('title'),
            'description'   => $this->og('description'),
            'thumbnail'     => $this->og('image'),
            'width'         => $this->og('video:width'),
            'height'        => $this->og('video:height'),
            'platform'      => 'youtube',
        ];
    }
}
