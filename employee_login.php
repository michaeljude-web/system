<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM employees WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee && password_verify($password, $employee['password'])) {
        $_SESSION['employee'] = $employee['email'];
        header("Location: employee_dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <style>
        body {
            background-color: #d1d8e0;
            font-family: 'Courier New', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #e0e0e0;
            padding: 30px;
            border: 2px solid #000;
            width: 320px;
            text-align: center;
        }

        h1 {
            font-size: 30px;
            color: #333;
            margin-bottom: 20px;
            text-shadow: 2px 2px #888;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        input {
            width: 92%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #333;
            background-color: #f5f5f5;
        }

        input:focus {
            outline: 1px dashed #333;
        }

        .login-button {
            width: 99%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: 1px solid #000;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-button:hover {
            background-color: #555;
        }

        .login-button:active {
            background-color: #000;
            color: #fff;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Employee Login</h1>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</body>

</html>
