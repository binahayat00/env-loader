<?php

declare(strict_types=1);

namespace EnvLoader\Services;

use EnvLoader\Exceptions\FileException;

class ConfigLoader
{
    public function __construct(protected ?string $configPath = null)
    {
        $this->configPath = $configPath ? realpath($configPath) : realpath(dirname(__DIR__, 2) . '/configs');

        if (!$this->configPath) {
            throw new FileException("Invalid config directory: $configPath");
        }
    }

    public function load(string $file): array
    {
        $filePath = "{$this->configPath}/{$file}.php";

        if (!file_exists($filePath)) {
            throw new FileException("Config file not found: $filePath");
        }

        return require $filePath;
    }

    public static function loadStatic(string $file, ?string $configPath = null): array
    {
        $loader = new self($configPath);
        return $loader->load($file);
    }
}
