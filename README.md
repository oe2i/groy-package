# Groy Schema (`oe2i/groy-schema`)

An opinionated Laravel 13 package for database schema definitions and migrations.

## Requirements

- PHP `^8.5`
- Laravel `^13.0`

## Installation

```bash
composer require oe2i/groy-schema
```

## Documentation

- [Installation & Setup](docs/installation.md)
- [Configuration](docs/configuration.md)
- [Schema Definitions](docs/schema-definitions.md)
- [Migrations](docs/migrations.md)
- [Facade (`SchemaX`)](docs/facade.md)
- [Testing with Orchestra Testbench](docs/testing.md)
- [Using as a Package Starter Kit](docs/starter-kit.md)
- [Contributing & Releases](docs/contributing.md)

## Quick Start

```php
use Groy\Schema\Facades\Schema as SchemaX;
```

## Using as a Package Starter Kit

Create a new Laravel 13 package from this repository:

```bash
composer create-project oe2i/groy-schema my-package
```

The `post-create-project-cmd` script (`scripts/configure.php`) will prompt for your new package name, PSR-4 namespace, and description, update all references, and remove itself automatically. See [docs/starter-kit.md](docs/starter-kit.md) for details.

## Local Development & Verification

1. **Install dependencies**:
   ```bash
   composer install
   ```
2. **Verify Orchestra Testbench & Pest**:
   - Ensure `tests/TestCase.php` extends `Orchestra\Testbench\TestCase` and registers `Groy\Schema\Providers\SchemaServiceProvider` in `getPackageProviders()`.
   - Run the test suite:
     ```bash
     composer ao:pest
     ```
3. **Run full quality & CI checks**:
   ```bash
   composer ao:test
   ```

### Available Scripts

```bash
composer ao:pest        # Run Pest tests
composer ao:coverage    # Run Pest with coverage
composer ao:parallel    # Run Pest in parallel
composer ao:type        # Type coverage check (min 90%)
composer ao:stan        # PHPStan / Larastan analysis
composer ao:pint        # Format code with Pint
composer ao:pint-check  # Check code style without modifying
composer ao:rector      # Run Rector
composer ao:rector-dry  # Dry-run Rector
composer ao:profanity   # Profanity check
composer ao:check       # Validate composer.json, platform reqs, audit, outdated
composer ci:check       # Full CI check
composer release        # Run release script
```

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
