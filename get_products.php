<?php
include 'db_connection.php';

try {
    // Query to fetch products from the database
    $stmt = $pdo->prepare("SELECT id, name, description, price FROM products");
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set the content type to JSON
    header('Content-Type: application/json');
    echo json_encode($products);

} catch (PDOException $e) {
    // Handle the error
    echo json_encode(['error' => $e->getMessage()]);
}
?>
