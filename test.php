<?php
$conn = mysqli_connect("12.0.0.1:3307", "root", "", "inventory_db");

if (!$conn) {
    die("FAILED: " . mysqli_connect_error());
}

echo "WORKING PERFECTLY";
?>