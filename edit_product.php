<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM products WHERE id=$id");
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $sql = "UPDATE products
            SET name='$name',
                quantity='$quantity',
                price='$price',
                category='$category'
            WHERE id=$id";

    if($conn->query($sql)){
        header("Location: products.php");
    }
}
?>

<h2>Edit Product</h2>

<form method="POST">

    <input type="text"
           name="name"
           value="<?php echo $row['name']; ?>">

    <br><br>

    <input type="number"
           name="quantity"
           value="<?php echo $row['quantity']; ?>">

    <br><br>

    <input type="number"
           step="0.01"
           name="price"
           value="<?php echo $row['price']; ?>">

    <br><br>

    <input type="text"
           name="category"
           value="<?php echo $row['category']; ?>">

    <br><br>

    <button name="update">
        Update Product
    </button>

</form>