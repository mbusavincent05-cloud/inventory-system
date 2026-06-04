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
</html>