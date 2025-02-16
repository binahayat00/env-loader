<?php

namespace EnvLoader\Contracts\Services;

interface LineServiceInterface
{
    public function splitToLines(string $content): array;
    
    public function handleLines(array $lines): array;
}
