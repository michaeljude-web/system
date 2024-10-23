
<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $starting_bid = $_POST['starting_bid'];
    $bid_end_time = $_POST['bid_end_time'];
    $status = $_POST['status'];
    $seller_id = 1;
    
    $image_url = null;
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
        }
    }

    $sql = "INSERT INTO products (product_name, description, starting_bid, bid_end_time, status, image_url, seller_id)
            VALUES (:product_name, :description, :starting_bid, :bid_end_time, :status, :image_url, :seller_id)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':starting_bid', $starting_bid);
    $stmt->bindParam(':bid_end_time', $bid_end_time);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->bindParam(':seller_id', $seller_id);

    if ($stmt->execute()) {
        echo '<script>alert("Product added successfully!")</script>';
    } else {
        echo '<script>alert("Faild to add Product")</script>';
    }
} else {
    echo "Invalid request method.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin|Dashboard</title>
    <link rel="stylesheet" href="assets/font/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        /** Sidebar all **/
        
        .sidebar {
            width: 190px;
            height: 100%;
            background-color: #c39fc3;
            position: fixed;
            left: 0;
            top: 0;
            border: 0.1px solid gray;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-left: 10px;
        }

        .sidebar a {
            padding: 15px;
            font-size: 20px;
            text-decoration: none;
            color: black;
            display: block;
        }
        
        .sidebar > h2 {
            text-align: center;
        }
        
        .sidebar > h2 > span, span {
            font-size: 1.5rem;
        }

        
        
      /*** Navbar ***/

        .navbar {
            display: none;
            background-color: #8fa3ee;
            padding: 10px;
        }

        .navbar a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: inline-block;
        }

        .toggle-button {
            font-size: 24px;
            cursor: pointer;
        }
        
        
        
          .logout {
            margin-top: auto; 
            padding: 15px;
            font-size: 20px;
            text-decoration: none;
            color: black;
              }
              
              
   /**     Content sa page **/           
              
        .content {
            margin-left: 190px;
            padding: 1px 20px;
            background-color: #f4f1f8;
            min-height: 100vh;
        }
        
        .header > p {
            font-size: 2rem;
            color: #333;
        }



        /****** Responsive ***********/

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .navbar {
                display: flex;
                justify-content: center;
                gap: 20px;
            }
            .content {
                margin-left: 0;
            }
            .header {
                display: none;
            }
        }
    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <br>
        <h2><span style="color: #ffff;">Blue</span><span>Market</span></h2>
        <a href="#"><i class="fa fa-home"></i> Home</a>
        <a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Product</a>
        <a href="admin_add_employee.php"><i class="fa fa-gavel" aria-hidden="true"></i> Bid</a>
        
        <a href="#">Contact</a>
         <a href="index.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
    
    <!-- Navbar -->
    <div class="navbar" id="navbar">
        <a href="#" title="Dashboard"><i class="fa fa-home"></i></a>
        <a href="admin_add_employee.php" title="Employees"><i class="fa fa-users"></i></a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
       
    </div>
    
    <!-- Content -->
    <div class="content">
        <div class="header">
            <p>Dashboard</p>
        </div>
        
        <div class="content">
    <div class="header">
        <p>Dashboard - Add Product</p>
    </div>
    
    <form id="addProductForm" action="admin_add_product.php" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="starting_bid">Starting Bid:</label>
        <input type="number" step="0.01" id="starting_bid" name="starting_bid" required><br><br>

        <label for="bid_end_time">Bid End Time:</label>
        <input type="datetime-local" id="bid_end_time" name="bid_end_time" required><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="active">Active</option>
            <option value="sold">Sold</option>
        </select><br><br>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <input type="submit" value="Add Product">
    </form>
</div>

    </div>
    
    <script>
        
    </script>
</body>
</html>
