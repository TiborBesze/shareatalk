<?php

namespace App\Services\MetaParser\Drivers;

interface DriverInterface
{
    public function parse($url);
}
