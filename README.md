# Mini Sistema CRUD — PHP PDO

> **Repository status:** learning / historical engineering evidence. This repository demonstrates PHP/PDO CRUD, validation and a small custom test runner. It is **not presented as production-ready software**.

## Verified scope

The current codebase contains:

- PHP 8-style typed code
- PDO database access
- SQLite local setup, with MySQL configuration example
- CRUD operations for items
- pagination support
- input validation
- HTML escaping/sanitization checks
- JSON API responses
- configurable CORS helpers
- a versioned custom test runner covering CRUD, validation, pagination and an XSS-oriented escaping case

## Repository structure

```text
Database.php            database connection abstraction
ItemModel.php           item persistence and validation
public/                 browser/API entry points
config.example.php      local configuration template
config_sqlite.php       SQLite-oriented development configuration
setup_sqlite.php        local SQLite setup
run_tests.php           custom functional test runner
sql.txt                 schema/reference SQL
```

## Local configuration

`config.php` is intentionally not versioned. Copy the example locally:

```bash
cp config.example.php config.php
```

Then configure your environment. Real credentials must never be committed.

The provided example enables debug mode and permissive CORS for local development. Those values are not production defaults.

## Run with SQLite

```bash
php setup_sqlite.php
php -S localhost:8000 -t public
```

## Tests

The repository includes a small custom PHP test runner rather than a PHPUnit/Jest-style framework:

```bash
php run_tests.php
```

The versioned suite exercises listing, creation, retrieval, update, input validation, deletion, pagination and an escaping/XSS-oriented case. This README intentionally does not claim a coverage percentage because no reproducible coverage report is versioned.

## Security / hardening notes

This project is retained as learning evidence. Before production use it would require, at minimum, environment-specific CORS, debug disabled, centralized configuration/secrets management, stronger observability, a standard test framework/CI pipeline, authentication/authorization where required, and a broader security review.

## Portfolio classification

**Category:** PHP / PDO learning evidence  
**Visibility:** Public  
**Portfolio priority:** Low  
**Recommended use:** Historical evidence of PHP/PDO, CRUD and validation work; not a pinned repository.

See the main [GitHub profile](https://github.com/JavierQuinan) and [Portfolio Governance](https://github.com/JavierQuinan/JavierQuinan/blob/main/docs/PORTFOLIO_GOVERNANCE.md).

## License

MIT — see `LICENSE`.
