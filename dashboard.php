<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
require 'db.php';

/*
Optional login protection later:
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
*/

// TOTAL PRODUCTS
$totalProductsQuery = $conn->query("SELECT COUNT(*) AS total FROM products");
$totalProducts = $totalProductsQuery->fetch_assoc()['total'];

// TOTAL STOCK (SUM OF QUANTITY)
$totalStockQuery = $conn->query("SELECT SUM(quantity) AS stock FROM products");
$totalStock = $totalStockQuery->fetch_assoc()['stock'];

// TOTAL CATEGORIES
$totalCategoryQuery = $conn->query("SELECT COUNT(DISTINCT category) AS categories FROM products");
$totalCategories = $totalCategoryQuery->fetch_assoc()['categories'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    
    body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            position: fixed;
            color: white;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
        }

        .topbar {
            background: white;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
        }

        .card p {
            font-size: 26px;
            color: #27ae60;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>Inventory</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="products.php">Products</a>
    <a href="add_product.php">Add Product</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">

    <div class="topbar">
        <h2>Inventory Dashboard</h2>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Total Products</h3>
            <p><?php echo $totalProducts; ?></p>
        </div>

        <div class="card">
            <h3>Total Stock</h3>
            <p><?php echo $totalStock ? $totalStock : 0; ?></p>
        </div>

        <div class="card">
            <h3>Categories</h3>
            <p><?php echo $totalCategories; ?></p>
        </div>

    </div>

    <a class="btn" href="products.php">View Products</a>

</div>

</body>
</html>