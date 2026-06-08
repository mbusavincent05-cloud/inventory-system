<<<<<<< HEAD
<?php
include 'db.php';

// Interactive Search Logic
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
if (!empty($search)) {
    $result = $conn->query("SELECT * FROM products WHERE name LIKE '%$search%' OR category LIKE '%$search%'");
} else {
    $result = $conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Shared Core Layout Framework */
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #2b3541;
            margin: 0;
            display: flex;
        }

        /* Sidebar Styling (Matched directly to screenshot) */
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

        /* Viewport Frame Box */
        .main-content {
            margin-left: 240px;
            flex-grow: 1;
            padding: 35px 40px;
            min-height: 100vh;
        }

        /* UI Panel Heading Element */
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

        /* Component Data Cards */
        .dashboard-card {
            background: #ffffff;
            border-radius: 6px;
            border: 1px solid #e8ebf0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            padding: 30px;
        }

        /* Interactive Buttons matching Accent Green (#22af62) */
        .btn-theme-green {
            background-color: #22af62;
            border-color: #22af62;
            color: #ffffff;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }
        .btn-theme-green:hover {
            background-color: #1b9451;
            border-color: #1b9451;
            color: #ffffff;
        }

        /* Search Interface Controls */
        .search-input {
            border: 1px solid #ced4da;
            border-radius: 4px 0 0 4px !important;
            padding-left: 14px;
        }
        .search-input:focus {
            border-color: #22af62;
            box-shadow: 0 0 0 3px rgba(34, 175, 98, 0.15);
        }
        .search-btn {
            border-radius: 0 4px 4px 0 !important;
            background-color: #34495e;
            border-color: #34495e;
            color: #ffffff;
        }
        .search-btn:hover {
            background-color: #2c3e50;
        }

        /* Clean Minimal Table Theme */
        .table-custom thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 14px 16px;
            border-bottom: 2px solid #edf2f7;
        }
        .table-custom tbody td {
            padding: 16px;
            color: #334155;
            font-size: 0.95rem;
            border-bottom: 1px solid #f1f5f9;
        }
        
        /* Interactive Row Element Badges */
        .category-tag {
            background-color: #ebf5ff;
            color: #1e40af;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
        .action-btn {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.2s;
        }
        .action-edit { color: #3182ce; }
        .action-edit:hover { background-color: #edf2f7; }
        .action-delete { color: #e53e3e; }
        .action-delete:hover { background-color: #fff5f5; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Inventory</div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li class="active"><a href="products.php">Products</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li style="margin-top: 50px;"><a href="logout.php" style="opacity: 0.7;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="header-panel">
            <h1 class="header-title">Product Matrix</h1>
        </div>

        <div class="dashboard-card">
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-md-6 col-lg-5">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control search-input" placeholder="Search product directory..." value="<?php echo htmlspecialchars($search); ?>">
                            <button class="btn search-btn" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-lg-7 text-end">
                    <a href="add_product.php" class="btn btn-theme-green">+ Add New Product</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="35%">Product Name</th>
                            <th width="15%">Stock Level</th>
                            <th width="15%">Unit Price</th>
                            <th width="15%">Category</th>
                            <th width="10%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0) { ?>
                            <?php while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td class="text-muted">#<?php echo $row['id']; ?></td>
                                <td class="fw-semibold text-dark"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td>
                                    <span class="<?php echo $row['quantity'] < 5 ? 'text-danger fw-bold' : ''; ?>">
                                        <?php echo $row['quantity']; ?> items
                                    </span>
                                </td>
                                <td class="fw-medium">$<?php echo number_format($row['price'], 2); ?></td>
                                <td>
                                    <span class="category-tag"><?php echo htmlspecialchars($row['category']); ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="action-btn action-edit">Edit</a>
                                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="action-btn action-delete" onclick="return confirm('Permanently remove product record?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No matching inventory matches found.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
=======
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
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
