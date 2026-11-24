<?php

declare(strict_types=1);

$root = dirname(__DIR__);

$ask = static function (string $prompt, string $default): string {
    echo "{$prompt} [{$default}]: ";
    $input = trim((string) fgets(STDIN));

    return $input !== '' ? $input : $default;
};

$package = $ask('Package name (vendor/package)', 'oe2i/groy-schema');
$namespace = $ask('PSR-4 Namespace', 'Groy\\Schema');
$description = $ask('Description', 'Opinionated Laravel 13 package.');

$namespaceEscaped = str_replace('\\', '\\\\', $namespace);
$repoUrl = "https://github.com/{$package}";

$composerPath = "{$root}/composer.json";
$composer = file_get_contents($composerPath);
if ($composer !== false) {
    $composer = str_replace(
        ['oe2i/groy-schema', 'Groy\\\\Schema', 'Opinionated Laravel 13 package for database schema definitions and migrations.'],
        [$package, $namespaceEscaped, $description],
        $composer
    );

    $data = json_decode($composer, true);
    if (is_array($data)) {
        unset($data['scripts']['post-create-project-cmd']);
        file_put_contents($composerPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).PHP_EOL);
    }
}

$files = [
    "{$root}/README.md",
    "{$root}/src/Providers/SchemaServiceProvider.php",
    "{$root}/tests/TestCase.php",
    "{$root}/tests/Pest.php",
    "{$root}/tests/Feature/ServiceProviderTest.php",
];

foreach ($files as $file) {
    if (! file_exists($file)) {
        continue;
    }

    $content = file_get_contents($file);
    if ($content === false) {
        continue;
    }

    $content = str_replace(
        ['oe2i/groy-schema', 'Groy\\Schema', 'https://github.com/oe2i/groy-schema'],
        [$package, $namespace, $repoUrl],
        $content
    );
    file_put_contents($file, $content);
}

@unlink(__FILE__);

echo PHP_EOL."Configured {$package} ({$namespace}).".PHP_EOL;
