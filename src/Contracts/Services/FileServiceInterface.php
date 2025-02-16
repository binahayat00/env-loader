<?php

declare(strict_types=1);

namespace EnvLoader\Contracts\Services;

interface FileServiceInterface
{
    public function checkFileExist(string $filePath): bool;

    public function getFileContent(string $filePath): ?string;

    public function validatedContent(string $path, string $fileName): ?string;
}
