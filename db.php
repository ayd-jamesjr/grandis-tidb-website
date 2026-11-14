<?php
declare(strict_types=1);

/**
 * Grandis database connection.
 *
 * Supply credentials through environment variables. For local development,
 * a .env file may be used; it must never be committed to Git.
 */

// Load a local .env file only when process-level variables are not already set.
// Hosting-platform environment variables take precedence.
$envFile = __DIR__ . '/.env';

if (is_file($envFile) && is_readable($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if ($name === '' || getenv($name) !== false) {
            continue;
        }

        // Remove matching surrounding quotes from simple .env values.
        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];

            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        putenv($name . '=' . $value);
        $_ENV[$name] = $value;
    }
}

$requiredVariables = [
    'TIDB_HOST',
    'TIDB_DB_NAME',
    'TIDB_USER',
    'TIDB_PASSWORD',
];

$config = [];

foreach ($requiredVariables as $variable) {
    $value = getenv($variable);

    if ($value === false || trim($value) === '') {
        error_log('Grandis configuration error: required environment variable ' . $variable . ' is missing.');
        http_response_code(503);
        exit('The website is temporarily unavailable. Please try again later.');
    }

    $config[$variable] = trim($value);
}

$port = getenv('TIDB_PORT') ?: '4000';
$caPath = getenv('TIDB_SSL_CA') ?: '/etc/ssl/certs/ca-certificates.crt';

if (!is_file($caPath) || !is_readable($caPath)) {
    error_log('Grandis configuration error: the configured TiDB TLS CA file is missing or unreadable.');
    http_response_code(503);
    exit('The website is temporarily unavailable. Please try again later.');
}

try {
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $config['TIDB_HOST'],
        $port,
        $config['TIDB_DB_NAME']
    );

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
        PDO::MYSQL_ATTR_SSL_CA => $caPath,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
    ];

    $pdo = new PDO(
        $dsn,
        $config['TIDB_USER'],
        $config['TIDB_PASSWORD'],
        $options
    );
} catch (PDOException $exception) {
    // Keep connection details in server logs, never in the visitor response.
    error_log('Grandis database connection failed: ' . $exception->getMessage());
    http_response_code(503);
    exit('The website is temporarily unavailable. Please try again later.');
}
