<?php

declare(strict_types=1);

namespace Groy\Package\Providers;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/groy-package.php', 'groy-package');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/groy-package.php' => config_path('groy-package.php'),
            ], 'groy-package-config');
        }
    }
}
