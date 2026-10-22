<?php
// Simple loader for local .env file if it exists
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

$host     = getenv('TIDB_HOST') ?: 'gateway01.eu-central-1.prod.aws.tidbcloud.com';
$port     = getenv('TIDB_PORT') ?: 4000;
$dbname   = getenv('TIDB_DB_NAME') ?: 'grandis_db';
$user     = getenv('TIDB_USER') ?: '44MXJVTJcEKYEoq.root';
$password = getenv('TIDB_PASSWORD') ?: 'ZY5YIubb2nlqmFiS';

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        
        // --- CRITICAL TLS/SSL FIX FOR TIDB CLOUD ---
        PDO::MYSQL_ATTR_SSL_CA => true,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
    ];

    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>