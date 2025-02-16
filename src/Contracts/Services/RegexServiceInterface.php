<?php

declare(strict_types=1);

namespace EnvLoader\Contracts\Services;

interface RegexServiceInterface
{
    public function isCommentOrWhitespace(string $line): bool;

    public function removeDoubleQuotes(string $text): string;

}
