# Contributing & Releases

## Local Setup

```bash
composer install
composer ci:check
```

## Releases

Releases are created from `main` using:

```bash
composer release -- <major|minor|patch>
```

This creates an annotated semver tag, pushes it to `origin`, and creates a GitHub Release for `minor` and `major` bumps.
