<?php
$host = '127.0.0.1';
$db   = 'alumni';
$user = 'root';
$pass = ''; // default XAMPP empty password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    if (strpos($e->getMessage(), 'Unknown database') !== false) {
        die("Database 'alumni' does not exist. Please visit setup_database.php first.");
    }
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
