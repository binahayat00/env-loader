<?php

declare(strict_types=1);

namespace EnvLoader\Factories;

use EnvLoader\Contracts\Factories\Factory;
use EnvLoader\Env;
use EnvLoader\Factories\Services\LineServiceFactory;
use EnvLoader\Services\FileService;

class EnvFactory implements Factory
{
    public static function create(): Env
    {
        return new Env(
            new FileService(), 
            LineServiceFactory::create()
        );
    }
}
