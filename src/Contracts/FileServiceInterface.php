<?php

namespace SimpleEnv\Contracts;

interface FileServiceInterface
{
    public function checkFileExist(string $filePath): bool;
    
    public function getFileContent(string $filePath);
}
