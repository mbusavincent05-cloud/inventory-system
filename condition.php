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
</form>