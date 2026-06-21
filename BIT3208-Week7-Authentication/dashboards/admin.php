<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="alert alert-danger p-5">
        <h2>System Control Panel (Administrator)</h2>
        <p>User: <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></p>
        <p>Full system access: Manage user accounts, view audit logs, and override application configurations.</p>
        <hr>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>