<?php
session_start();

include 'db_connection.php'; 


$max_attempts = 31;
$lockout_duration = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if ($admin['lockout_time'] && strtotime($admin['lockout_time']) > time()) {
            $remaining = ceil((strtotime($admin['lockout_time']) - time()) / 60);
            $error = "Account is locked. Try again after $remaining minutes.";
        } else {
            if ($admin['lockout_time'] && strtotime($admin['lockout_time']) < time()) {
                $stmt = $pdo->prepare("UPDATE admin SET login_attempts = 0, lockout_time = NULL WHERE username = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $admin['login_attempts'] = 0;
            }

            if (password_verify($password, $admin['password'])) {
                $stmt = $pdo->prepare("UPDATE admin SET login_attempts = 0, lockout_time = NULL WHERE username = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                $_SESSION['admin'] = $admin['username'];
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $login_attempts = $admin['login_attempts'] + 1;

                if ($login_attempts >= $max_attempts) {
                    $lockout_time = date("Y-m-d H:i:s", strtotime("+$lockout_duration hours"));
                    $stmt = $pdo->prepare("UPDATE admin SET login_attempts = :login_attempts, lockout_time = :lockout_time WHERE username = :username");
                    $stmt->bindParam(':login_attempts', $login_attempts);
                    $stmt->bindParam(':lockout_time', $lockout_time);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                    $error = "Account is locked. Try again after $lockout_duration hour(s).";
                } else {
                    $stmt = $pdo->prepare("UPDATE admin SET login_attempts = :login_attempts WHERE username = :username");
                    $stmt->bindParam(':login_attempts', $login_attempts);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                    $error = "Invalid password. You have $login_attempts out of $max_attempts attempts.";
                }
            }
        }
    } else {
        sleep(1);
        $error = "Invalid username or password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
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
            width: 93%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #333;
            background-color: #f5f5f5;
        }

        /* input:focus {
            outline: 2px dashed #333;
        } */

        .login-button {
            width: 100%;
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
        <h1>Admin</h1>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Submit</button>
        </form>
    </div>
</body>
</html>