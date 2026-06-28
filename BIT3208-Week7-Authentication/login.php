<?php
// 1. Start the session at the very top of the file
session_start();

// 2. Include database connection
require_once 'config/db.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Fetch the user by email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // 3. Verify password against the secure hash in the DB
        if ($user && password_verify($password, $user['password'])) {
            
            // Security best practice: prevent session fixation
            session_regenerate_id(true);

            // 4. SAVE DATA INTO THE SESSION
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['user_role']  = $user['role']; // 'student', 'lecturer', or 'admin'

            // 5. Role-Based Routing
            if ($_SESSION['user_role'] === 'admin') {
                header("Location: dashboards/admin_dashboard.php");
            } elseif ($_SESSION['user_role'] === 'lecturer') {
                header("Location: dashboards/lecturer_dashboard.php");
            } else {
                header("Location: dashboards/student_dashboard.php");
            }
            exit(); // Always stop script execution after a redirect
            
        } else {
            $error = "Invalid email or password.";
        }
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