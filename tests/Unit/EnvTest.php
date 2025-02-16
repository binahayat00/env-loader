<?php

declare(strict_types=1);

namespace Tests\Unit;

use EnvLoader\Factories\EnvFactory;
use Tests\BaseTestCase;

class EnvTest extends BaseTestCase
{
    public function testEnvFileLoads()
    {
        EnvFactory::create()->load($this->envPath,'.env.example');

        $this->assertEquals('env-loader',getenv('APP_NAME'));
        $this->assertEquals('env-loader',$_ENV['APP_NAME']);
    }
}
