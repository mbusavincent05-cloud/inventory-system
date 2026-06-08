<?php

session_start();

$_SESSION['user'] = "Mercy and Tevez";

echo "Session created for: " . $_SESSION['user'];

?>