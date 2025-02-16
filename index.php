<?php

declare(strict_types=1);

use EnvLoader\Factories\EnvFactory;

require __DIR__ . '/vendor/autoload.php';

$env = EnvFactory::create();

var_dump($env->load(__DIR__));

//TODO need to delete