<?php
require_once 'config/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if email or username exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);
    
    if ($stmt->fetch()) {
        $message = "Username or Email already registered!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$username, $email, $password, $role])) {
            header("Location: login.php?msg=registered");
            exit;
        } else {
            $message = "An error occurred. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portal Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-lightd-flex align-items-center justify-content-center" style="height: 100vh;">
<div class="card p-4 shadow" style="width: 400px; margin: 100px auto;">
    <h3 class="text-center mb-4">Create Account</h3>
    <?php if($message): ?>
        <div class="alert alert-danger"><?= $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Portal Role</label>
            <select name="role" class="form-control">
                <option value="student">Student</option>
                <option value="lecturer">Lecturer</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
        <p class="text-center mt-3"><a href="login.php">Already have an account? Login</a></p>
    </form>
</div>
</body>
</html>