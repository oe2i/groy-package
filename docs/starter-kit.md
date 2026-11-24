# Using as a Package Starter Kit

Create a new Laravel 13 package from this starter kit:

```bash
composer create-project oe2i/groy-package my-package
```

The `post-create-project-cmd` script (`scripts/configure.php`) will:

1. Prompt for your package name (`vendor/package`), PSR-4 namespace, and description.
2. Update `composer.json`, `README.md`, `src/`, and `tests/` with your new package details.
3. Remove `post-create-project-cmd` from `composer.json` and delete `scripts/configure.php`.
