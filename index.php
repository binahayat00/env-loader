<?php

use SimpleEnv\Env;
use SimpleEnv\Services\FileService;

require __DIR__ . '/vendor/autoload.php';

$randomArray = (
    new Env(
        new FileService()
    )
)->get(__DIR__);

var_dump($randomArray);