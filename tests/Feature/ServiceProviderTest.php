<?php

declare(strict_types=1);

use Groy\Package\Providers\PackageServiceProvider;

it('boots the package service provider', function (): void {
    expect(app()->getProvider(PackageServiceProvider::class))
        ->toBeInstanceOf(PackageServiceProvider::class);
});
