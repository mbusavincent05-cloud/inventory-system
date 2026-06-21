<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="alert alert-primary p-5">
        <h2>Welcome to the Student Portal, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>You can now view your grades, registered units, and fee statements here.</p>
        <hr>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>