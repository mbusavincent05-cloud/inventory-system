<?php
include 'db.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $sql = "INSERT INTO products(name, quantity, price, category)
            VALUES('$name','$quantity','$price','$category')";

    if($conn->query($sql)){
        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Add Product</h2>

<form method="POST">
    Product Name:<br>
    <input type="text" name="name" required><br><br>

    Quantity:<br>
    <input type="number" name="quantity" required><br><br>

    Price:<br>
    <input type="number" step="0.01" name="price" required><br><br>

    Category:<br>
    <input type="text" name="category"><br><br>

    <button type="submit" name="submit">Add Product</button>
</form>

<br>
<a href="products.php">View Products</a>