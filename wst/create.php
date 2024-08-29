<?php
include 'db.php'; #db conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    $sql = "INSERT INTO products (name, description, price, quantity, barcode) VALUES (:name, :description, :price, :quantity, :barcode)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(array(
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':quantity' => $quantity,
            ':barcode' => $barcode,
        ));
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}