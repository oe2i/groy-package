# Testing with Orchestra Testbench

This package uses [Pest](https://pestphp.com/) and [Orchestra Testbench](https://packages.tools/testbench) for testing.

## Running Tests

```bash
composer ao:pest
```

## Writing Tests

- Feature tests live in `tests/Feature/`.
- Unit tests live in `tests/Unit/`.
- `tests/TestCase.php` registers `Groy\Package\Providers\PackageServiceProvider` automatically.

## Quality & Static Analysis

```bash
composer ao:stan       # PHPStan / Larastan
composer ao:pint-check # Laravel Pint style check
composer ao:type       # Pest type coverage
composer oe:ci         # Full CI suite
```
