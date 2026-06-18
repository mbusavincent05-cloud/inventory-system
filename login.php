<?php
session_start();
include "db.php";

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){

        $_SESSION['user'] = $username;

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div style="width:350px;margin:100px auto;background:white;padding:25px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,.1);">

    <h2> Tevez Login</h2>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required style="width:100%;padding:10px;"><br><br>

        <input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;"><br><br>

        <button 
        <div  class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Inventory Login</h3> 
                </div>

                <div class="card-body">

                    <form method="POST">

                        <input
                            type="text"
                            name="username"
                            class="form-control mb-3"
                            placeholder="Username"
                            required
                        >

                        <input
                            type="password"
                            name="password"
                            class="form-control mb-3"
                            placeholder="Password"
                            required
                        >

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
            Login
        </button>

    </form>

    <?php
    if($error != ""){
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

</div>

</body>
</html>
<?php
session_start();
include "db.php";

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){

        $_SESSION['user'] = $username;

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div style="width:350px;margin:100px auto;background:white;padding:25px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,.1);">

    <h2> Tevez Login</h2>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required style="width:100%;padding:10px;"><br><br>

        <input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;"><br><br>

        <button 
        <div  class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Inventory Login</h3> 
                </div>

                <div class="card-body">

                    <form method="POST">

                        <input
                            type="text"
                            name="username"
                            class="form-control mb-3"
                            placeholder="Username"
                            required
                        >

                        <input
                            type="password"
                            name="password"
                            class="form-control mb-3"
                            placeholder="Password"
                            required
                        >

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
            Login
        </button>

    </form>

    <?php
    if($error != ""){
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

</div>

</body>
</html>