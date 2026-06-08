<<<<<<< HEAD
<?php

include "db.php";

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(username,email,password)
            VALUES('$username','$email','$password')";

    if($conn->query($sql)){
        echo "Registration Successful";
    }else{
        echo "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<h2>Registration Form</h2>

<form method="POST">

    <input type="text"
           name="username"
           placeholder="Username"
           required>

    <br><br>

    <input type="email"
           name="email"
           placeholder="Email"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <br><br>
<button type="submit" name="register">
    Register
</button>

</form>

</body>
=======
<?php

include "db.php";

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(username,email,password)
            VALUES('$username','$email','$password')";

    if($conn->query($sql)){
        echo "Registration Successful";
    }else{
        echo "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<h2>Registration Form</h2>

<form method="POST">

    <input type="text"
           name="username"
           placeholder="Username"
           required>

    <br><br>

    <input type="email"
           name="email"
           placeholder="Email"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <br><br>
<button type="submit" name="register">
    Register
</button>

</form>

</body>
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
</html>