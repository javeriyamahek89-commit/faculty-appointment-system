<?php

// Detect hosting environment
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {

    // XAMPP Localhost Settings
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "faculty_appointment";

} else {

    // InfinityFree Hosting Settings
    $host = "YOUR_INFINITY_DB_HOST";
    $user = "YOUR_INFINITY_DB_USERNAME";
    $password = "YOUR_INFINITY_DB_PASSWORD";
    $database = "YOUR_INFINITY_DB_NAME";
}

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>