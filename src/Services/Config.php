<?php

declare(strict_types=1);

namespace EnvLoader\Services;

use EnvLoader\Contracts\Services\ConfigServiceInterface;

class Config implements ConfigServiceInterface
{
    private array $flattenedConfig = [];

    public function __construct(private readonly array $config)
    {
        $this->flattenConfig($this->config);
    }

    private function flattenConfig(array $array, string $prefix = ''): void
    {
        foreach ($array as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;

            if (is_array($value)) {
                $this->flattenConfig($value, $fullKey);
            } else {
                $this->flattenedConfig[$fullKey] = $value;
            }
        }
    }

    public function get(string $name, mixed $default = null): mixed
    {
        return $this->flattenedConfig[$name] ?? $default;
    }
}
