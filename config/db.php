<?php
// Database configuration
$host = 'localhost';         // Database server (localhost for local development)
$db = 'quiz_platform';       // Database name
$user = 'root';              // MySQL username (default for local servers like XAMPP)
$pass = '';                  // MySQL password (leave empty for default on XAMPP)

// Establish a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
