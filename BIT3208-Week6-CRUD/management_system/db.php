<?php
$host = "localhost:3307";
$user = "root";       // Default XAMPP username
$pass = "";           // Default XAMPP password
$dbname = "campus_library_system";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>