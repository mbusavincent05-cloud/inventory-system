<?php 
include 'db.php'; 

// --- HANDLE STUDENT CRUD ACTIONS ---
if (isset($_POST['action_student'])) {
    $sid = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    if ($_POST['action_student'] == 'add') {
        $conn->query("INSERT INTO students VALUES ('$sid', '$name', '$email', '$course')");
    } elseif ($_POST['action_student'] == 'update') {
        $conn->query("UPDATE students SET name='$name', email='$email', course='$course' WHERE student_id='$sid'");
    }
    header("Location: index.php");
}
if (isset($_GET['delete_student'])) {
    $sid = $_GET['delete_student'];
    $conn->query("DELETE FROM students WHERE student_id='$sid'");
    header("Location: index.php");
}

// --- HANDLE BOOK CRUD ACTIONS ---
if (isset($_POST['action_book'])) {
    $bid = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    if ($_POST['action_book'] == 'add') {
        $conn->query("INSERT INTO books VALUES ('$bid', '$title', '$author', '$category')");
    } elseif ($_POST['action_book'] == 'update') {
        $conn->query("UPDATE books SET title='$title', author='$author', category='$category' WHERE book_id='$bid'");
    }
    header("Location: index.php");
}
if (isset($_GET['delete_book'])) {
    $bid = $_GET['delete_book'];
    $conn->query("DELETE FROM books WHERE book_id='$bid'");
    header("Location: index.php");
}

// Check if we are currently editing a student or book
$edit_s = $edit_b = null;
if (isset($_GET['edit_student'])) {
    $res = $conn->query("SELECT * FROM students WHERE student_id='{$_GET['edit_student']}'");
    $edit_s = $res->fetch_assoc();
}
if (isset($_GET['edit_book'])) {
    $res = $conn->query("SELECT * FROM books WHERE book_id='{$_GET['edit_book']}'");
    $edit_b = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management Dashboards</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
        .container { display: flex; gap: 30px; margin-bottom: 40px; }
        .panel { flex: 1; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #333; padding-bottom: 5px; color: #333; }
        input, select { width: 95%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #007BFF; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button.cancel { background: #6c757d; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; text-align: left; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn-edit { color: #28a745; text-decoration: none; margin-right: 10px; font-weight: bold;}
        .btn-del { color: #dc3545; text-decoration: none; font-weight: bold;}
    </style>
</head>
<body>

    <h1 style="text-align:center; color:#222;">Management System</h1>
    <hr><br>

    <div class="container">
        <div class="panel">
            <h2>Student Management</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="action_student" value="<?php echo $edit_s ? 'update' : 'add'; ?>">
                
                <label>Student ID:</label>
                <input type="text" name="student_id" value="<?php echo $edit_s['student_id'] ?? ''; ?>" <?php echo $edit_s ? 'readonly style="background:#eee;"' : 'required'; ?>>
                
                <label>Full Name:</label>
                <input type="text" name="name" value="<?php echo $edit_s['name'] ?? ''; ?>" required>
                
                <label>Email Address:</label>
                <input type="email" name="email" value="<?php echo $edit_s['email'] ?? ''; ?>" required>
                
                <label>Course:</label>
                <input type="text" name="course" value="<?php echo $edit_s['course'] ?? ''; ?>" required>
                
                <button type="submit"><?php echo $edit_s ? 'Update Student' : 'Add Student'; ?></button>
                <?php if ($edit_s): ?><a href="index.php"><button type="button" class="cancel">Cancel</button></a><?php endif; ?>
            </form>

            <table>
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th></tr>
                <?php
                $result = $conn->query("SELECT * FROM students");
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['course']}</td>
                            <td>
                                <a class='btn-edit' href='index.php?edit_student={$row['student_id']}'>Edit</a>
                                <a class='btn-del' href='index.php?delete_student={$row['student_id']}' onclick='return confirm(\"Delete student?\")'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <div class="panel">
            <h2>Library Book Management</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="action_book" value="<?php echo $edit_b ? 'update' : 'add'; ?>">
                
                <label>Book ID:</label>
                <input type="text" name="book_id" value="<?php echo $edit_b['book_id'] ?? ''; ?>" <?php echo $edit_b ? 'readonly style="background:#eee;"' : 'required'; ?>>
                
                <label>Book Title:</label>
                <input type="text" name="title" value="<?php echo $edit_b['title'] ?? ''; ?>" required>
                
                <label>Author:</label>
                <input type="text" name="author" value="<?php echo $edit_b['author'] ?? ''; ?>" required>
                
                <label>Category:</label>
                <input type="text" name="category" value="<?php echo $edit_b['category'] ?? ''; ?>" required>
                
                <button type="submit"><?php echo $edit_b ? 'Update Book' : 'Add Book'; ?></button>
                <?php if ($edit_b): ?><a href="index.php"><button type="button" class="cancel">Cancel</button></a><?php endif; ?>
            </form>

            <table>
                <tr><th>Book ID</th><th>Title</th><th>Author</th><th>Category</th><th>Actions</th></tr>
                <?php
                $result = $conn->query("SELECT * FROM books");
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['book_id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['author']}</td>
                            <td>{$row['category']}</td>
                            <td>
                                <a class='btn-edit' href='index.php?edit_book={$row['book_id']}'>Edit</a>
                                <a class='btn-del' href='index.php?delete_book={$row['book_id']}' onclick='return confirm(\"Delete book?\")'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>
</html>