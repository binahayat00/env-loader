<?php

declare(strict_types=1);

namespace EnvLoader\Contracts\Services;

interface ConfigServiceInterface
{
    public function get(string $name, mixed $defaut = null): mixed;
}
