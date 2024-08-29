<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Crud</title>
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
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Barcode</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php'; # db connection

                # Fetch data from the db
                $sql = "SELECT * FROM products";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(); // Execute the prepared statement

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["barcode"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["createdAt"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["updatedAt"]) . "</td>";
                        echo "<td>
                                <a href='update.php?id=" . $row["id"] . "'>Edit</a> | 
                                <a href='delete.php?id=" . $row["id"] . "'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <h2>My Products</h2>
        <form action="create.php" method="post">

            <label for="name">Name:</label>
            <input type="text" name="name" required><br>
            <label for="description">Description:</label>
            <input type="text" name="description"><br>
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required><br>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" required><br>
            <label for="barcode">Barcode:</label>
            <input type="text" name="barcode"><br><br>

            <input type="submit" value="Add">
        </form>
    </div>
</body>

</html>
