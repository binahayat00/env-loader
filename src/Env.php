<?php

namespace Amir\StudiousOctoFortnight;

class Env
{
    public function __construct(
    ) {
    }

    public function get($path): array
    {
        $defaultName = '.env';
        $filePath = "$path/$defaultName";

        if (!$this->checkFileExist($filePath)) {
            return [];
        }

        $content = $this->getFile($filePath);

        if (!$content) {
            return [];
        }

        $convertedContent = mb_convert_encoding($content, 'UTF-8');
        $splitContent = (array) preg_split("/(\r\n|\n|\r)/", $convertedContent);

        if (\preg_last_error() !== \PREG_NO_ERROR) {
            preg_last_error_msg();
            return [];
        }

        $lines = [];
        $buffer = [];
        foreach ($splitContent as $line) {
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
            if ($line === '' || (isset($line[0]) && $line[0] === '#')) {
                return [];
            }

            [$key, $value] = array_map('trim', \explode('=', $line, 2));
            $value = preg_replace(
                '/^"(.*)"$/',
                '$1',
                trim($value),
            );

            $lines[$key] = $value;
            $this->setToEnv($key, $value);
        }

        return $lines;
    }

    public function setToEnv(string $key, string $value): void
    {
        $_ENV[$key] = $value;
    }

    public function checkFileExist(string $filePath): bool
    {
        if (!file_exists($filePath)) {
            return false;//TODO Exception 
        }
        return true;
    }

    public function getFile(string $filePath)
    {
        $content = file_get_contents($filePath, false);

        if (strlen($content) === 0) {
            return false;//TODO Exception 
        }

        return $content;
    }
}
