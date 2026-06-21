<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'lecturer') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="alert alert-success p-5">
        <h2>Welcome to the Lecturer Portal, Dr. <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Access privileges granted: Upload CAT marks, update course outlines, and manage class lists.</p>
        <hr>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>