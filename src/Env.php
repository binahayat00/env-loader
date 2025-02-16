<?php

declare(strict_types=1);

namespace EnvLoader;

use EnvLoader\Enums\File;
use EnvLoader\Services\ConfigLoader;
use EnvLoader\Contracts\Services\FileServiceInterface;
use EnvLoader\Contracts\Services\LineServiceInterface;
use EnvLoader\Services\Config;

class Env
{
    protected ?Config $config;

    public function __construct(
        protected FileServiceInterface $fileService,
        protected LineServiceInterface $lineService
    ) {
    }

    public function load(string $path, ?string $fileName = null, ?string $configPath = null,?string $configFileName = File::DEFAULTCONFIGFILE->value): array
    {
        $this->config = $this->setConfigs($configFileName, $configPath);
        $content = $this->fileService->validatedContent($path, $fileName ?? $this->config->get('file.name.default'));
        if ($content === null) {
            return [];
        }

        $convertedContent = mb_convert_encoding($content, 'UTF-8');

        $lines = $this->lineService->splitToLines($convertedContent);

        return $this->lineService->handleLines($lines);
    }

    private function setConfigs(string $configFileName, ?string $configPath)
    {
        $config = ConfigLoader::loadStatic($configFileName, $configPath);
        return $this->config = new Config($config);

    }
}
