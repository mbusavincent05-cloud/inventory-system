<<<<<<< HEAD
<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM products WHERE id=$id");

header("Location: products.php");
exit();
=======
<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM products WHERE id=$id");

header("Location: products.php");
exit();
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
?>