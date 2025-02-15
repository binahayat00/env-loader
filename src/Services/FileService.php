<?php

declare(strict_types=1);

namespace SimpleEnv\Services;

use SimpleEnv\Contracts\FileServiceInterface;

class FileService implements FileServiceInterface
{
    public function checkFileExist(string $filePath): bool
    {
        if (!file_exists($filePath)) {
            return false;//TODO Exception
        }
        return true;
    }

    public function getFileContent(string $filePath)
    {
        $content = file_get_contents($filePath, false);

        if (strlen($content) === 0) {
            return false;//TODO Exception 
        }

        return $content;
    }
}
