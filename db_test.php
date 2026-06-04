<?php

$conn =
new mysqli(
"localhost:3307",
"root",
"",
"inventory_db"
);

if($conn->connect_error)
{
    die("Connection Failed");
}

echo "Database Connected Successfully";

?>