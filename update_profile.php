
<?php
session_start(); // Start session to access user data

include 'db_connection.php'; // Make sure this is the correct path

$user_id = $_SESSION['user_id']; // Adjust according to your session variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Hash password if provided

    try {
        // Prepare update statement
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, address = :address, email = :email" . ($password ? ", password = :password" : "") . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

        // If password is provided, bind it
        if ($password) {
            $stmt->bindParam(':password', $password);
        }

        // Execute the statement
        $stmt->execute();

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
