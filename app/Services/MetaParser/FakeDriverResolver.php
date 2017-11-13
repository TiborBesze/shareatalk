<?php

namespace App\Services\MetaParser;

use App\Services\MetaParser\Drivers\FakeDriver;

class FakeDriverResolver implements DriverResolverInterface
{
    public function getDriverByURL($url)
    {
        return new FakeDriver;
    }
}
