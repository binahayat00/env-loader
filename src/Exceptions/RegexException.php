<?php

declare(strict_types=1);

namespace EnvLoader\Exceptions;

class RegexException extends \Exception
{

    public function __construct(string $message, protected string $pattern = '', protected string $input = '', int $code = 0, ?\Throwable $previous = null)
    {
        $detailedMessage = $message;

        if ($pattern !== '') {
            $detailedMessage .= " | Pattern: $pattern";
        }

        if ($input !== '') {
            $detailedMessage .= " | Input: " . json_encode($input);
        }

        parent::__construct($detailedMessage, $code, $previous);
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getInput(): string
    {
        return $this->input;
    }
}
