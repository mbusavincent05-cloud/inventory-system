<?php
$conn = new mysqli("12.0.0.1:3307", "root", "", "inventory_db");

if ($conn->connect_error) {
    die("FAILED: " . $conn->connect_error);
}

echo "CONNECTED SUCCESSFULLY";
?>