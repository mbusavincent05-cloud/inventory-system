<?php
include 'db.php';

$result = $conn->query("SELECT * FROM products");
?>

<h2>Product List</h2>

<a href="add_product.php">Add New Product</a>

<br>
<form method="GET">

    <input type="text" name="search" placeholder="Search product...">

    <button class="btn btn-primary">Search</button>

</form>

</br>
<table class="table table-bordered table-striped table-hover shadow">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Category</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['category']; ?></td>

    <td>
        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>

        |

        <a href="delete_product.php?id=<?php echo $row['id']; ?>">
            Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>