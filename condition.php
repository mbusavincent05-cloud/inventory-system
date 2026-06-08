<<<<<<< HEAD
<?php

if(isset($_POST['username'])){

    $username = $_POST['username'];

    if($username == "admin"){
        echo "Access Granted";
    } else {
        echo "Access Denied";
    }
}

?>

<form method="POST">
    <input type="text" name="username">
    <button type="submit">Check</button>
=======
<?php

if(isset($_POST['username'])){

    $username = $_POST['username'];

    if($username == "admin"){
        echo "Access Granted";
    } else {
        echo "Access Denied";
    }
}

?>

<form method="POST">
    <input type="text" name="username">
    <button type="submit">Check</button>
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
</form>