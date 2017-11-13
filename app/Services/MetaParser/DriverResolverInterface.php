<?php

namespace App\Services\MetaParser;

interface DriverResolverInterface
{
    public function getDriverByURL($url);
}
