<?php
/**
 * db.php - Database Configuration for TiDB Cloud
 * Uses PDO MySQL driver configured for secure TLS/SSL connection to TiDB Cloud.
 */

$host     = getenv('TIDB_HOST') ?: 'gateway01.us-east-1.prod.aws.tidbcloud.com';
$port     = getenv('TIDB_PORT') ?: 4000;
$dbname   = getenv('TIDB_DB_NAME') ?: 'grandis_db';
$user     = getenv('TIDB_USER') ?: 'your_username.root';
$password = getenv('TIDB_PASSWORD') ?: 'your_tidb_password';

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];

    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    // Graceful error message without exposing private credentials
    die("<div style='padding:20px; font-family:sans-serif; color:#991b1b; background:#fee2e2; border:1px solid #ef4444; border-radius:8px; max-width:600px; margin:50px auto;'>
            <h3>Database Connection Failed</h3>
            <p>Could not connect to TiDB Cloud. Please check your environment configuration or credentials.</p>
         </div>");
}
?>
