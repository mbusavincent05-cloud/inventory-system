<<<<<<< HEAD
<?php
$conn = new mysqli("12.0.0.1:3307", "root", "", "inventory_db");

if ($conn->connect_error) {
    die("FAILED: " . $conn->connect_error);
}

echo "CONNECTED SUCCESSFULLY";
=======
<?php
$conn = new mysqli("12.0.0.1:3307", "root", "", "inventory_db");

if ($conn->connect_error) {
    die("FAILED: " . $conn->connect_error);
}

echo "CONNECTED SUCCESSFULLY";
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
?>