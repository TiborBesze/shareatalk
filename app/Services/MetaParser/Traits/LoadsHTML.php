<?php

namespace App\Services\MetaParser\Traits;

trait LoadsHTML
{
    protected $metas;

    protected function load($html)
    {
        $old_libxml_error = libxml_use_internal_errors(true);

        $document = new \DOMDocument();
        $document->loadHTML($html);

        libxml_use_internal_errors($old_libxml_error);

        return $document;
    }

    protected function loadMetas($document)
    {
        $this->metas = collect($document->getElementsByTagName('meta'))->map(function ($meta) {
            if ($meta->hasAttribute('property') && $meta->hasAttribute('content')) {
                return [
                    'property'  => $meta->getAttribute('property'),
                    'content'   => $meta->getAttribute('content'),
                ];
            }
        })->reject(function ($meta) {
            return $meta === null;
        });

        $this->metas->macro('og', function ($property) {
            return collect($this->items)
                ->where('property', 'og:' . $property)
                ->first()['content'];
        });

        return !!$this->metas->count();
    }

    protected function og($property) {
        return $this->metas->og($property);
    }
}
