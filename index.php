<?php

use Amir\StudiousOctoFortnight\Env;

require __DIR__.'/vendor/autoload.php';

$randomArray = (new Env)->get(__DIR__);

var_dump($randomArray);