<?php
// db_connection.php - assuming this file contains your PDO connection
include 'db_connection.php';

try {
    // Get the JSON input from the request
    $input = json_decode(file_get_contents("php://input"), true);
    $productId = $input['productId'];
    $bidAmount = $input['bidAmount'];

    // Insert the bid into the bids table
    $stmt = $pdo->prepare("INSERT INTO bids (product_id, bid_amount) VALUES (:productId, :bidAmount)");
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':bidAmount', $bidAmount, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to place bid']);
    }

} catch (PDOException $e) {
    // Handle the error
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
