<?php

namespace EnvLoader\Factories\Services;

use EnvLoader\Contracts\Factories\Factory;
use EnvLoader\Services\LineService;
use EnvLoader\Services\RegexService;

class LineServiceFactory implements Factory
{
    public static function create()
    {
        return new LineService(new RegexService());
    }
}
