<?php

declare(strict_types=1);

namespace EnvLoader\Services;

use EnvLoader\Contracts\Services\FileServiceInterface;

class FileService implements FileServiceInterface
{
    public function checkFileExist(string $filePath): bool
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("Env file not found at: $filePath");
        }

        return true;
    }

    public function getFileContent(string $filePath): ?string
    {
        $content = file_get_contents($filePath, false);

        if (strlen($content) === 0) {
            return null;
        }

        return $content;
    }

    public function validatedContent(string $path, string $fileName): ?string
    {
        $filePath = "$path/$fileName";

        $this->checkFileExist($filePath);

        return $this->getFileContent($filePath);
    }
}
