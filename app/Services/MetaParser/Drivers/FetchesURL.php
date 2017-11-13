<?php

namespace App\Services\MetaParser\Drivers;

trait FetchesURL
{
    protected function fetch($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response ?: null;
    }
}
