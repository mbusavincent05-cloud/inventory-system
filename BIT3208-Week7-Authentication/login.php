<?php
session_start();
require_once 'config/db.php';
$message = '';

if (isset($_GET['msg']) && $_GET['msg'] == 'registered') {
    $message = "Registration successful! Please login.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID for security against session fixation
        session_regenerate_id(true);
        
        $_author_session['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] == 'admin') header("Location: dashboards/admin.php");
        elseif ($user['role'] == 'lecturer') header("Location: dashboards/lecturer.php");
        else header("Location: dashboards/student.php");
        exit;
    } else {
        $message = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portal Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="card p-4 shadow" style="width: 400px; margin: 150px auto;">
    <h3 class="text-center mb-4">Portal Login</h3>
    <?php if($message): ?>
        <div class="alert alert-info"><?= $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
        <p class="text-center mt-3"><a href="register.php">New user? Register here</a></p>
    </form>
</div>
</body>
</html>