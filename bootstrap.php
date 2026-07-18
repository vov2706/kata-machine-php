<?php

declare(strict_types=1);

/**
 * Test bootstrap — wired into phpunit via `bootstrap="bootstrap.php"`.
 *
 * It registers an autoloader that resolves every `Kata\<Name>` class from the
 * *current day* folder (see `kata.config.php`). This is the PHP analogue of the
 * original project's `@code/*` path alias: your tests always import the kata you
 * are practising today, and switching days is a one-line config change that
 * `scripts/generate.php` makes for you.
 */

$root = __DIR__;

/** @var array{day:string,dsa:array<int,string>} $config */
$config = require $root . '/kata.config.php';
$day = $config['day'] ?? 'day1';

spl_autoload_register(static function (string $class) use ($root, $day): void {
    $prefix = 'Kata\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = str_replace('\\', '/', substr($class, strlen($prefix)));

    // Prefer the current day's implementation; fall back to shared helpers
    // living directly under src/ (e.g. Kata\Types\Foo -> src/Types/Foo.php).
    $candidates = [
        "$root/src/$day/$relative.php",
        "$root/src/$relative.php",
    ];

    foreach ($candidates as $file) {
        if (is_file($file)) {
            require $file;
            return;
        }
    }
});

// Shared test fixtures/helpers. Loaded here (rather than discovered as a test)
// because it has no `Test.php` suffix, so phpunit never collects it as a suite.
require $root . '/src/__tests__/Fixtures.php';
