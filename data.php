<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM cameras ORDER BY id DESC");
$cameras = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera Store - Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
            color: #333;
        }

        .camera-grid {
            display: grid;
            grid-template-colum
            .camera-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: auto;
        }

        .camera-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .camera-card:hover {
            transform: scale(1.03);
        }

        .camera-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .camera-content {
            padding: 15px;
        }

        .camera-content h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #2c3e50;
        }

        .camera-content p {
            font-size: 14px;
            color: #666;
            height: 60px;
            overflow: hidden;
        }

        .camera-content .price {
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }

        .camera-content .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease-in-out;
        }

        .camera-content .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h1 style="text-align:center;">📸 Available Cameras</h1>
    
    <div class="camera-grid">
        <?php foreach ($cameras as $camera): ?>
            <div class="camera-card">
                <img src="<?= htmlspecialchars($camera['image']) ?>" alt="<?= htmlspecialchars($camera['name']) ?>">
                <div class="camera-content">
                    <h3><?= htmlspecialchars($camera['name']) ?></h3>
                    <p><?= htmlspecialchars($camera['description']) ?></p>
                    <div class="price">$<?= number_format($camera['price'], 2) ?></div>
                    <a href="#" class="btn">Buy Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
