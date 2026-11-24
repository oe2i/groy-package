<?php

declare(strict_types=1);

use Groy\Schema\Providers\SchemaServiceProvider;

it('boots the schema service provider', function (): void {
    expect(app()->getProvider(SchemaServiceProvider::class))
        ->toBeInstanceOf(SchemaServiceProvider::class);
});
