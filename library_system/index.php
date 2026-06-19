<?php
require_once 'db.php';

$message = "";
$update_mode = false;
$up_id = $up_title = $up_author = $up_category = "";

// --- CREATE ---
if (isset($_POST['create'])) {
    $book_id = trim($_POST['book_id']);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);

    if (!empty($book_id) && !empty($title) && !empty($author) && !empty($category)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO books (book_id, title, author, category) VALUES (?, ?, ?, ?)");
            $stmt->execute([$book_id, $title, $author, $category]);
            $message = "<div style='color:green;'>✅ Book added successfully!</div>";
        } catch (PDOException $e) {
            $message = "<div style='color:red;'>❌ Error: Book ID might already exist.</div>";
        }
    } else {
        $message = "<div style='color:red;'>⚠️ All fields are required.</div>";
    }
}

// --- DELETE ---
if (isset($_GET['delete'])) {
    $book_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->execute([$book_id]);
    $message = "<div style='color:orange;'>🗑️ Book deleted successfully.</div>";
}

// --- PREPARE UPDATE (Fetch data into form) ---
if (isset($_GET['edit'])) {
    $update_mode = true;
    $book_id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM books WHERE book_id = ?");
    $stmt->execute([$book_id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($book) {
        $up_id = $book['book_id'];
        $up_title = $book['title'];
        $up_author = $book['author'];
        $up_category = $book['category'];
    }
}

// --- PROCESS UPDATE ---
if (isset($_POST['update'])) {
    $book_id = $_POST['book_id'];
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, category = ? WHERE book_id = ?");
    $stmt->execute([$title, $author, $category, $book_id]);
    $message = "<div style='color:green;'>🔄 Book updated successfully!</div>";
    $update_mode = false;
}

// --- READ (Fetch all books) ---
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Book Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f4f9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007BFF; color: white; }
        .form-container { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 400px; margin-bottom: 30px; }
        input, select { width: 95%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; }
        .btn-add { background-color: #28a745; }
        .btn-update { background-color: #ffc107; color: black; }
        .btn-edit { background-color: #17a2b8; text-decoration: none; padding: 5px 10px; color: white; border-radius: 3px; }
        .btn-delete { background-color: #dc3545; text-decoration: none; padding: 5px 10px; color: white; border-radius: 3px; }
    </style>
</head>
<body>

    <h2>📚 Library Book Management System</h2>
    <?php echo $message; ?>

    <div class="form-container">
        <h3><?php echo $update_mode ? "Update Book Details" : "Add New Book"; ?></h3>
        <form action="index.php" method="POST">
            <label>Book ID:</label>
            <input type="text" name="book_id" value="<?php echo $up_id; ?>" <?php echo $update_mode ? 'readonly style="background:#eee;"' : ''; ?> required>
            
            <label>Book Title:</label>
            <input type="text" name="title" value="<?php echo $up_title; ?>" required>
            
            <label>Author:</label>
            <input type="text" name="author" value="<?php echo $up_author; ?>" required>
            
            <label>Category:</label>
            <input type="text" name="category" value="<?php echo $up_category; ?>" required>
            
            <?php if ($update_mode): ?>
                <button type="submit" name="update" class="btn-update">Update Book</button>
                <a href="index.php" style="margin-left: 10px; color: #555;">Cancel</a>
            <?php else: ?>
                <button type="submit" name="create" class="btn-add">Add Book</button>
            <?php endif; ?>
        </form>
    </div>

    <h3>Current Library Inventory</h3>
    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($books) > 0): ?>
                <?php foreach ($books as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['book_id']; ?>" class="btn-edit">Edit</a>
                            <a href="index.php?delete=<?php echo $row['book_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #777;">No books found in the library database.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>