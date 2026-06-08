<<<<<<< HEAD
<?php
include 'db.php';

$message = '';
$messageClass = '';

// Interactive Form Processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $category = $conn->real_escape_string($_POST['category']);

    // Backend Safety Validation
    if (!empty($name) && !empty($category) && $quantity >= 0 && $price >= 0) {
        $sql = "INSERT INTO products (name, quantity, price, category) VALUES ('$name', $quantity, $price, '$category')";
        
        if ($conn->query($sql)) {
            $message = "Product successfully cataloged into inventory!";
            $messageClass = "alert-success-theme";
        } else {
            $message = "Database Error: " . $conn->error;
            $messageClass = "alert-danger-theme";
        }
    } else {
        $message = "Please fill out all fields with valid data values.";
        $messageClass = "alert-danger-theme";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard - Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Form Element Interactive Focus Rules extending style.css */
        .form-label {
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(34, 175, 98, 0.15);
            color: var(--text-dark);
        }
        /* Contextual feedback notices matching the system colors */
        .alert-success-theme {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 4px;
            padding: 15px;
        }
        .alert-danger-theme {
            background-color: #fff5f5;
            border: 1px solid #feb2b2;
            color: #9b2c2c;
            border-radius: 4px;
            padding: 15px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Inventory</div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li class="active"><a href="add_product.php">Add Product</a></li>
            <li style="margin-top: 50px;"><a href="logout.php" style="opacity: 0.7;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="header-panel">
            <h1 class="header-title">Add New Product</h1>
        </div>

        <div class="dashboard-card" style="max-width: 650px;">
            
            <?php if (!empty($message)): ?>
                <div class="mb-4 <?php echo $messageClass; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="add_product.php" class="needs-validation" novalidate>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="e.g., Wireless Mouse Nano">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Initial Quantity Stock</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0" required placeholder="0">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Unit Selling Price ($)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required placeholder="0.00">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="category" class="form-label">Inventory Category Assignment</label>
                    <input type="text" class="form-control" id="category" name="category" required placeholder="e.g., Electronics, Office Supply">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-theme-green">Save Product Record</button>
                    <a href="products.php" class="text-secondary text-decoration-none small fw-semibold">Cancel and Return</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

</body>
</html>
=======
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
>>>>>>> cedd30dac97f3868e5367d7169ec120d0f186600
