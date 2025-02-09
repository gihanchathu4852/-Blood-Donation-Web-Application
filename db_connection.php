<?php
// Database configuration
$dbHost = 'localhost'; // Change this to your database host
$dbUsername = 'root'; // Change this to your database username
$dbPassword = ''; // Change this to your database password
$dbName = 'blood'; // Change this to your database name

// Attempt to connect to the database
try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set character set to UTF-8
    $pdo->exec("set names utf8");
    
    echo "Connected successfully";
} catch (PDOException $e) {
    // Display error message
    die("Connection failed: " . $e->getMessage());
}
?>
