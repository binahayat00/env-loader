<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    protected $envPath;
    protected function setUp(): void
    {
        $this->envPath = dirname( __DIR__);
    }
}
