<?php

$host = '127.0.0.1';
$user = 'root';
$pass = ''; // default XAMPP empty password

try {
    // Connect without a specific DB
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create Database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS alumni");
    echo "Database 'alumni' created successfully (or already exists).<br>";

    // Use the database
    $pdo->exec("USE alumni");

    // Create Table
    $sql = "CREATE TABLE IF NOT EXISTS alumni_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100),
        phone VARCHAR(20),
        passout_year VARCHAR(10) NOT NULL,
        section VARCHAR(10) NOT NULL,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Table 'alumni_requests' created successfully (or already exists).<br>";
    echo "<br><a href='alumni.php'>Go back to Alumni Page</a>";

} catch (PDOException $e) {
    die("DB Setup ERROR: " . $e->getMessage());
}
?>
