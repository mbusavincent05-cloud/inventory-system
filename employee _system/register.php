<?php
// Database connection configuration
$host     = "localhost:3307";
$username = "root";       // Default XAMPP/MAMP username
$password = "";           // Default XAMPP password is empty
$dbname   = "employee_db"; // Make sure this matches your phpMyAdmin database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name  = $conn->real_escape_string($_POST['last_name']);
    $email      = $conn->real_escape_string($_POST['email']);
    $phone      = $conn->real_escape_string($_POST['phone']);
    $department = $conn->real_escape_string($_POST['department']);
    $role       = $conn->real_escape_string($_POST['role']);
    $salary     = !empty($_POST['salary']) ? floatval($_POST['salary']) : 0.00;
    
    // Automatically generate a unique Employee ID (e.g., EMP65F2)
    $employee_id = "EMP" . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
    $join_date   = date("Y-m-d");

    // Insert query
    $sql = "INSERT INTO employees (employee_id, first_name, last_name, email, phone, department, role, salary, join_date) 
            VALUES ('$employee_id', '$first_name', '$last_name', '$email', '$phone', '$department', '$role', '$salary', '$join_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert success'>✅ Employee registered successfully! ID: <strong>$employee_id</strong></div>";
    } else {
        if ($conn->errno == 1062) {
            $message = "<div class='alert danger'>❌ Error: Email address already exists.</div>";
        } else {
            $message = "<div class='alert danger'>❌ Error: " . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Registration</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f0f2f5; 
            padding: 40px 20px; 
            margin: 0;
        }
        .form-container { 
            max-width: 550px; 
            background: white; 
            padding: 30px; 
            margin: auto; 
            border-radius: 12px; 
            box-shadow: 0px 4px 20px rgba(0,0,0,0.08); 
        }
        h2 { 
            margin-top: 0; 
            color: #333; 
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #444;
            font-size: 14px;
        }
        
        /* --- Styled Filling Boxes (Inputs) --- */
        input[type="text"], input[type="email"], input[type="number"] { 
            width: 100%; 
            padding: 12px; 
            box-sizing: border-box; 
            border: 2px solid #e2e8f0; 
            border-radius: 8px; 
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f8fafc; /* Subtle background color */
        }

        /* Distinct color accents on Focus (when clicked) */
        input[name="first_name"]:focus, input[name="last_name"]:focus {
            border-color: #3b82f6; /* Blue border */
            background-color: #eff6ff; 
            outline: none;
        }
        input[name="email"]:focus {
            border-color: #ec4899; /* Pink border */
            background-color: #fdf2f8;
            outline: none;
        }
        input[name="phone"]:focus {
            border-color: #10b981; /* Green border */
            background-color: #ecfdf5;
            outline: none;
        }
        input[name="department"]:focus, input[name="role"]:focus {
            border-color: #8b5cf6; /* Purple border */
            background-color: #f5f3ff;
            outline: none;
        }
        input[name="salary"]:focus {
            border-color: #f59e0b; /* Amber/Gold border */
            background-color: #fffbeb;
            outline: none;
        }

        /* Button Styling */
        button { 
            background-color: #1e293b; 
            color: white; 
            padding: 14px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            width: 100%; 
            font-size: 16px; 
            font-weight: 600;
            margin-top: 10px;
            transition: background 0.2s;
        }
        button:hover { 
            background-color: #0f172a; 
        }

        /* Status Alerts */
        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .success { background-color: #dcfce7; color: #14532d; border: 1px solid #bbf7d0; }
        .danger { background-color: #fee2e2; color: #7f1d1d; border: 1px solid #fecaca; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Register New Employee</h2>
    
    <?php echo $message; ?>
    
    <form action="register.php" method="POST">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" required placeholder="John">
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" required placeholder="Doe">
        </div>
        <div class="form-group">
            <label>Email Address:</label>
            <input type="email" name="email" required placeholder="john.doe@company.com">
        </div>
        <div class="form-group">
            <label>Phone Number:</label>
            <input type="text" name="phone" placeholder="+123456789">
        </div>
        <div class="form-group">
            <label>Department:</label>
            <input type="text" name="department" placeholder="IT, HR, Sales...">
        </div>
        <div class="form-group">
            <label>Job Title / Role:</label>
            <input type="text" name="role" placeholder="Software Engineer">
        </div>
        <div class="form-group">
            <label>Salary (USD):</label>
            <input type="number" step="0.01" name="salary" placeholder="5000.00">
        </div>
        <button type="submit">Register Employee</button>
    </form>
</div>

</body>
</html>