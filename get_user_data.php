<?php
// get_user_data.php
session_start(); // Start session to access user data

// Include your database connection file
include 'db_connection.php'; // Make sure this is the correct path

// Assuming you have user ID in the session after login
$user_id = $_SESSION['user_id']; // Adjust according to your session variable

try {
    $stmt = $pdo->prepare("SELECT firstname, lastname, address, email FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
