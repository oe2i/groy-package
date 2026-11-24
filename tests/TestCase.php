<?php

declare(strict_types=1);

namespace Groy\Schema\Tests;

use Groy\Schema\Providers\SchemaServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            SchemaServiceProvider::class,
        ];
    }
}
