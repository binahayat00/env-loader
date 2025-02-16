<?php

namespace EnvLoader\Services;

use EnvLoader\Contracts\Services\LineServiceInterface;
use EnvLoader\Contracts\Services\RegexServiceInterface;

class LineService implements LineServiceInterface
{
    public function __construct(
        protected RegexServiceInterface $regexService
        )
    {
    }
    public function splitToLines(string $content): array
    {
        return (array) preg_split("/(\r\n|\n|\r)/", $content);
    }

    public function handleLines(array $lines): array
    {//TODO needs to refactore
        $envs = [];
        $buffer = [];
        foreach ($lines as $line) {

            if (strpos($line, '="') !== false) {
                //looksLikeMultilineStart
                if ($line !== '"') {
                    $line = str_replace('\\\\', '', $line);
                    $count = (int) preg_match_all('/(?=([^\\\\]"))/', $line);

                    if ($count > 1) {
                        array_push($buffer, $line);
                        $line = \implode("\n", $buffer);
                    }
                }
            }

            //isCommentOrWhitespace
            $line = trim($line);
            if ($this->regexService->isCommentOrWhitespace($line)) {
                continue;
            }

            [$key, $value] = array_map('trim', \explode('=', $line, 2));
            
            $value = $this->regexService->removeDoubleQuotes($value);

            $envs[$key] = $value;
            $this->setToEnv($key, $value);
        }
        return $envs;
    }

    public function setToEnv(string $key, string $value): void
    {//TODO need to move to another class
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}
