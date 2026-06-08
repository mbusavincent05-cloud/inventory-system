<<<<<<< HEAD
<?php
include 'db.php';

// Dynamically compute layout statistics for overview cards
$productCountQuery = $conn->query("SELECT COUNT(*) as total FROM products");
$totalProducts = $productCountQuery->fetch_assoc()['total'] ?? 0;

$stockQuery = $conn->query("SELECT SUM(quantity) as total_stock FROM products");
$totalStock = $stockQuery->fetch_assoc()['total_stock'] ?? 0;

$categoryQuery = $conn->query("SELECT COUNT(DISTINCT category) as total_cats FROM products");
$totalCategories = $categoryQuery->fetch_assoc()['total_cats'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Exact Identical CSS System Styling used across both view layers */
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #2b3541;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 240px;
            background-color: #243242;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            z-index: 1000;
        }
        .sidebar-brand {
            font-size: 2rem;
            color: #ffffff;
            padding: 0 25px;
            margin-bottom: 35px;
            font-weight: 400;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li a {
            display: block;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            padding: 14px 25px;
            font-size: 1.05rem;
            transition: all 0.2s ease;
        }
        .sidebar-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }
        .sidebar-menu li.active a {
            background-color: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-weight: 500;
        }
        .main-content {
            margin-left: 240px;
            flex-grow: 1;
            padding: 35px 40px;
            min-height: 100vh;
        }
        .header-panel {
            background: #ffffff;
            border: 1px solid #eef0f3;
            border-radius: 4px;
            padding: 22px 25px;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .header-title {
            font-size: 1.75rem;
            font-weight: 400;
            margin: 0;
            color: #233142;
        }

        /* Overview Page Metric Blocks styling */
        .metric-card {
            background: #ffffff;
            border: 1px solid #e8ebf0;
            border-radius: 6px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }
        .metric-label {
            font-size: 1.5rem;
            color: #2b3541;
            margin-bottom: 15px;
            font-weight: 400;
        }
        .metric-value {
            font-size: 2.25rem;
            color: #22af62;
            font-weight: 600;
        }
        .btn-theme-green {
            background-color: #22af62;
            border-color: #22af62;
            color: #ffffff;
            font-weight: 500;
            padding: 10px 24px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s;
        }
        .btn-theme-green:hover {
            background-color: #1b9451;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Inventory</div>
        <ul class="sidebar-menu">
            <li class="active"><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li style="margin-top: 50px;"><a href="logout.php" style="opacity: 0.7;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-panel">
            <h1 class="header-title">Inventory Dashboard</h1>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="metric-card">
                    <div class="metric-label">Total Products</div>
                    <div class="metric-value"><?php echo $totalProducts; ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card">
                    <div class="metric-label">Total Stock</div>
                    <div class="metric-value"><?php echo $totalStock; ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card">
                    <div class="metric-label">Categories</div>
                    <div class="metric-value"><?php echo $totalCategories; ?></div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="products.php" class="btn btn-theme-green">View Products</a>
        </div>
    </div>

</body>
=======
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
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
</html>