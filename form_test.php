<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
    <title>Form Handling</title>
</head>
<body>

<h2>PHP Form Test</h2>

<form method="POST">

    <input type="text" name="username" placeholder="Enter Username">

    <button type="submit">Submit</button>

</form>

<?php
if(isset($_POST['username'])){
    $username = $_POST['username'];
    echo "<h3>You entered: " . $username . "</h3>";
}
?>

</body>
=======
<!DOCTYPE html>
<html>
<head>
    <title>Form Handling</title>
</head>
<body>

<h2>PHP Form Test</h2>

<form method="POST">

    <input type="text" name="username" placeholder="Enter Username">

    <button type="submit">Submit</button>

</form>

<?php
if(isset($_POST['username'])){
    $username = $_POST['username'];
    echo "<h3>You entered: " . $username . "</h3>";
}
?>

</body>
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
</html>