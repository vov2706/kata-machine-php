<?php

declare(strict_types=1);

/**
 * Day generator — the PHP analogue of `scripts/generate.js`.
 *
 * Run it with:  php scripts/generate.php
 *
 * It scaffolds the *next* `src/dayN` folder with an empty skeleton for every
 * kata listed in `kata.config.php` (`dsa`), then repoints the config's `day`
 * key at the new folder so the test bootstrap resolves `Kata\*` from it. Your
 * previous days are left untouched, giving you a fresh blank slate each run.
 *
 * Skeletons are built from the interface definitions in `scripts/dsa.php`,
 * which is the single source of truth for every kata's signature.
 */

$root = dirname(__DIR__);
$configPath = $root . '/kata.config.php';
$srcPath = $root . '/src';

/** @var array{day:string,dsa:array<int,string>} $config */
$config = require $configPath;
/** @var array<string,array<string,mixed>> $definitions */
$definitions = require __DIR__ . '/dsa.php';

// The next day is one past the highest existing `dayN` folder (or day1).
$day = 1;
$existing = [];
foreach (glob($srcPath . '/day*', GLOB_ONLYDIR) ?: [] as $dir) {
    if (preg_match('/day(\d+)$/', basename($dir), $m)) {
        $existing[] = (int) $m[1];
    }
}
if ($existing !== []) {
    $day = max($existing) + 1;
}

$dayName = "day{$day}";
$dayPath = "{$srcPath}/{$dayName}";

if (!is_dir($dayPath) && !mkdir($dayPath, 0777, true) && !is_dir($dayPath)) {
    fwrite(STDERR, "Could not create {$dayPath}\n");
    exit(1);
}

foreach ($config['dsa'] as $name) {
    if (!isset($definitions[$name])) {
        fwrite(STDERR, "kata '{$name}' has no definition in scripts/dsa.php\n");
        exit(1);
    }

    $file = "{$dayPath}/{$name}.php";
    if (is_file($file)) {
        // Never clobber work already sitting in this day folder.
        continue;
    }

    file_put_contents($file, render($name, $definitions[$name]));
}

// Point the test bootstrap at the freshly generated day.
$configSrc = file_get_contents($configPath);
$updated = preg_replace(
    "/('day'\\s*=>\\s*')day\\d+(')/",
    '${1}' . $dayName . '${2}',
    $configSrc,
    1,
);
if ($updated !== null && $updated !== $configSrc) {
    file_put_contents($configPath, $updated);
}

echo "Generated {$dayName} with " . count($config['dsa']) . " katas.\n";

/**
 * Render a single kata skeleton to a PHP source string.
 *
 * @param array<string,mixed> $def
 */
function render(string $name, array $def): string
{
    return ($def['type'] ?? 'class') === 'fn'
        ? renderFn($name, $def)
        : renderClass($name, $def);
}

/**
 * @param array<string,mixed> $def
 */
function renderClass(string $name, array $def): string
{
    $body = [];

    foreach ($def['properties'] ?? [] as $p) {
        $default = isset($p['default']) ? " = {$p['default']}" : '';
        $body[] = "    {$p['scope']} {$p['type']} \${$p['name']}{$default};";
    }
    if (!empty($def['properties'])) {
        $body[] = '';
    }

    $ctorArgs = $def['constructor']['args'] ?? '';
    $body[] = "    public function __construct({$ctorArgs})";
    $body[] = '    {';
    $body[] = '    }';

    foreach ($def['methods'] ?? [] as $m) {
        $body[] = '';
        foreach (docblock($m['doc'] ?? []) as $line) {
            $body[] = $line;
        }
        $body[] = "    public function {$m['name']}({$m['args']}): {$m['return']}";
        $body[] = '    {';
        $body[] = '    }';
    }

    return fileHeader($def['doc'], $name) . implode("\n", $body) . "\n}\n";
}

/**
 * @param array<string,mixed> $def
 */
function renderFn(string $name, array $def): string
{
    $body = [];
    foreach (docblock($def['methodDoc'] ?? []) as $line) {
        $body[] = $line;
    }
    $body[] = "    public static function {$def['fn']}({$def['args']}): {$def['return']}";
    $body[] = '    {';
    $body[] = '    }';

    return fileHeader($def['doc'], $name) . implode("\n", $body) . "\n}\n";
}

/**
 * The shared file header, class docblock and opening brace.
 *
 * @param list<string> $doc
 */
function fileHeader(array $doc, string $name): string
{
    $lines = [
        '<?php',
        '',
        'declare(strict_types=1);',
        '',
        'namespace Kata;',
        '',
        '/**',
    ];
    foreach ($doc as $line) {
        $lines[] = " * {$line}";
    }
    $lines[] = ' */';
    $lines[] = "class {$name}";
    $lines[] = '{';

    return implode("\n", $lines) . "\n";
}

/**
 * A method-level docblock, or no lines at all when there is nothing to say.
 *
 * @param list<string> $doc
 * @return list<string>
 */
function docblock(array $doc): array
{
    if ($doc === []) {
        return [];
    }

    $lines = ['    /**'];
    foreach ($doc as $line) {
        $lines[] = "     * {$line}";
    }
    $lines[] = '     */';

    return $lines;
}
