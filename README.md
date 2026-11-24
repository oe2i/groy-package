# Groy Schema

Opinionated Laravel 13 package for database schema definitions and migrations.

## Requirements

- PHP `^8.5`
- Laravel `^13.0`

## Installation

```bash
composer require oe2i/groy-schema
```

## Documentation

- [Installation & Setup](docs/installation.md)
- [Schema Definitions](docs/schema-definitions.md)
- [Migrations](docs/migrations.md)
- [Facade (`SchemaX`)](docs/facade.md)
- [Configuration](docs/configuration.md)

## Quick Start

```php
use Groy\Schema\Facades\Schema as SchemaX;
```

## Testing & Quality

```bash
composer ao:test
```

Individual checks:

```bash
composer ao:pest        # Run Pest tests
composer ao:coverage    # Run Pest with coverage
composer ao:type        # Type coverage check
composer ao:stan        # PHPStan / Larastan analysis
composer ao:pint        # Format code with Pint
composer ao:rector      # Run Rector
composer ao:profanity   # Profanity check
```

## Release

```bash
composer release
```

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
