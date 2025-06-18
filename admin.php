<?php
include 'db.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM coffees WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php");
    exit;
}

// Handle new product submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $image = $_POST['image'] ?? '';
    $description = $_POST['description'] ?? '';

    if ($name && $price && $image) {
        $stmt = $pdo->prepare("INSERT INTO coffees (name, price, image, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $price, $image, $description]);
        header("Location: admin.php");
        exit;
    }
}

// Fetch all products
$stmt = $pdo->query("SELECT * FROM coffees ORDER BY id DESC");
$coffees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Coffee Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        input[type="text"], textarea, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background: #5c4033;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #3e2c23;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>☕ Admin Dashboard - Coffee Products</h1>

        <h2>All Products</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($coffees as $coffee): ?>
                <tr>
                    <td><?= $coffee['id'] ?></td>
                    <td><?= htmlspecialchars($coffee['name']) ?></td>
                    <td><?= number_format($coffee['price'], 2) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $coffee['id'] ?>">Edit</a> |
                        <a href="admin.php?delete=<?= $coffee['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Add New Coffee Product</h2>
        <form method="POST" action="admin.php">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Price:</label>
            <input type="number" name="price" step="0.01" required>

            <label>Image Path (e.g., images/latte.jpg):</label>
            <input type="text" name="image" required>

            <label>Description:</label>
            <textarea name="description" rows="3"></textarea>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>