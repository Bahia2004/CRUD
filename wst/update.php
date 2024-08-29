<?php
include 'db.php'; #db conn
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    #Fetch the data from the db
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    #If the product not found, redirect back to the main
    if (!$product) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

#Update the product data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    $sql = "UPDATE products SET name = :name, description = :description, price = :price, quantity = :quantity, barcode = :barcode, updatedAt = NOW() WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'barcode' => $barcode,
        'id' => $id
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 830px;
            background-color: #1144;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            color: #eaeaea;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #555;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #666;
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>Update My Product</h2>
        <form action="update.php?id=<?php echo htmlspecialchars($product['id']); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>"><br>

            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required><br>

            <label for="barcode">Barcode:</label>
            <input type="text" name="barcode" value="<?php echo htmlspecialchars($product['barcode']); ?>"><br><br>

            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>
