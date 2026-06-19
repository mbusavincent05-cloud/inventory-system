<?php
$host = "localhost:3307";
$user = "root";       // Default phpMyAdmin username
$pass = "";           // Default phpMyAdmin password (blank for XAMPP)
$dbname = "library_db";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>