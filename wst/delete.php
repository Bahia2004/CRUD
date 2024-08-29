<?php
include 'db.php'; #db conn

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([':id' => $id]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}