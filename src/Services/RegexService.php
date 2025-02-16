<?php

declare(strict_types=1);

namespace EnvLoader\Services;

use EnvLoader\Exceptions\RegexException;
use EnvLoader\Contracts\Services\RegexServiceInterface;

class RegexService implements RegexServiceInterface
{
    public function isCommentOrWhitespace(string $line): bool
    {
        return $line === '' || str_starts_with($line, '#');
    }

    public function removeDoubleQuotes(string $text): string
    {
        $pattern = '/^"(.*)"$/';
        $result = preg_replace($pattern,'$1',trim($text));

        self::checkError($pattern, $text);

        return $result;
    }

    public static function checkError(string $pattern = '', string $text = '')
    {
        $error = preg_last_error();

        if ($error !== \PREG_NO_ERROR) {
            $errorMessage = match ($error) {
                \PREG_INTERNAL_ERROR     => 'Internal PCRE error',
                \PREG_BACKTRACK_LIMIT_ERROR => 'Backtrack limit was exhausted',
                \PREG_RECURSION_LIMIT_ERROR => 'Recursion limit was exhausted',
                \PREG_BAD_UTF8_ERROR => 'Malformed UTF-8 characters in the input',
                \PREG_BAD_UTF8_OFFSET_ERROR => 'Invalid UTF-8 offset error',
                default => 'Unknown regex error'
            };

            throw new RegexException("Error in Regex: ". preg_last_error_msg() . ' - ' . $errorMessage,$pattern,$text);
        }
    }

    public function __destruct()
    {
        self::checkError();
    }
}
