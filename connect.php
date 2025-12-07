<?php
// We use __DIR__ to make sure the file is created in the current folder
$db_file = __DIR__ . '/todo_app.sqlite';

try {
    // Connect to SQLite file
    $conn = new PDO("sqlite:$db_file");
    
    // Set error mode to exception for easier debugging
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Enable foreign keys
    $conn->exec("PRAGMA foreign_keys = ON;");

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>