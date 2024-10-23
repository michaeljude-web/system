<?php
include 'db_connection.php'; // Include your database connection
// Handle bidding
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bid'])) {
    $product_id = $_POST['product_id'];
    $user_id = 1; // Replace with the actual user ID from session or other means
    $bid_amount = $_POST['bid_amount'];

    // Insert bid into database (assumed there's a bids table)
    $bid_sql = "INSERT INTO bids (product_id, user_id, bid_amount) VALUES (:product_id, :user_id, :bid_amount)";
    $bid_stmt = $pdo->prepare($bid_sql);
    $bid_stmt->bindParam(':product_id', $product_id);
    $bid_stmt->bindParam(':user_id', $user_id);
    $bid_stmt->bindParam(':bid_amount', $bid_amount);
    
    if ($bid_stmt->execute()) {
        echo '<script>alert("Bid placed successfully!")</script>';
    } else {
        echo '<script>alert("Failed to place bid.")</script>';
    }
}

// Fetch products from the database
$sql = "SELECT * FROM products WHERE status = 'active'"; // Adjust as needed
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pang Online Selling</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: Papyrus;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #ff6f61;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .navbar li {
            display: inline-block;
            margin: 0 15px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        .search-bar {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            border: none;
            border-radius: 3px;
        }

        .search-bar button {
            border: none;
            background: none;
            cursor: pointer;
            color: white;
        }

        section {
            padding: 20px;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            flex: 1 1 200px;
            text-align: center;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f8f8;
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar li {
                display: block;
                margin: 5px 0;
            }
        }

        /* Profile */
        .profile-container {
            position: relative;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ff6f61;
            cursor: pointer;
            position: relative;
        }

        .profile-icon i {
            font-size: 20px;
        }

        /* Dropdown Menu for Edit Profile and Logout */
        .profile-dropdown {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .profile-dropdown a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }

        .profile-dropdown a:hover {
            background-color: #f0f0f0;
        }

        .profile-dropdown i {
            margin-right: 10px; /* Space between icon and text */
        }

        .profile-container:hover .profile-dropdown {
            display: block;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
        }

        .modal-content input {
            width: 94%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            padding: 10px 15px;
            background-color: #ff6f61;
            color: white;
            width: 100%;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .close-modal {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }





        /* General styles for the products section */
#products {
    padding: 2rem;
    background-color: #f9f9f9;
}

#products h2 {
    text-align: center;
    color: #333;
    margin-bottom: 1.5rem;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
}

/* Styles for each product card */
.product-card {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-card img {
    width: 100%;
    height: 150px; 
    object-fit: cover; 
}

.product-card h3 {
    font-size: 1.2rem;
    margin: 0.5rem 0;
    padding: 0 1rem;
}

.product-card p {
    padding: 0 1rem;
    margin: 0.5rem 0;
    color: #666;
}

.starting-bid {
    font-weight: bold;
    color: #007BFF; /* Bootstrap primary color */
}

.bid-end-time {
    font-style: italic;
}

/* Styles for the bid form */
.product-card form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem;
}

.product-card label {
    margin-bottom: 0.5rem;
}

.product-card input[type="number"] {
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 0.5rem;
    width: 100%;
}

.product-card input[type="submit"] {
    background-color: #28a745; /* Green */
    color: white;
    border: none;
    padding: 0.7rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.product-card input[type="submit"]:hover {
    background-color: #218838; /* Darker green */
}

    </style>
</head>

<body>
    <nav class="navbar">
        <h1>Blue Market</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search products...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#contact">Contact</a></li>
            <li>
                <div class="profile-container">
                    <div class="profile-icon" id="profileIcon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-dropdown">
                        <a id="editProfileBtn"><i class="fas fa-edit"></i>Edit Profile</a>
                        <a href="users_login.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>

    <section id="home">
        <h2>Welcome to Our Store</h2>
        <p>Shop the best products online!</p>
    </section>

    <section id="products">
    <h2>Our Products</h2>
    <div class="product-grid" id="productGrid">
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p class="starting-bid">Starting Bid: $<?php echo number_format($product['starting_bid'], 2); ?></p>
                    <p class="bid-end-time">Bid End Time: <?php echo htmlspecialchars($product['bid_end_time']); ?></p>
                    
                    <!-- Bid Form -->
                    <form action="users_dashboard.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <label for="bid_amount">Your Bid:</label>
                        <input type="number" step="0.01" name="bid_amount" required>
                        <input type="submit" name="bid" value="Place Bid">
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</section>


    

    <footer id="contact">
        <p>Contact Us</p>
    </footer>
<!-- Modal for Editing Profile -->
<div class="modal" id="editProfileModal">
    <div class="modal-content">
        <span class="close-modal" id="closeModal">&times;</span>
        <h2>Edit Profile</h2>
        <form id="editProfileForm" enctype="multipart/form-data">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="New Password">
            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>




<script>
 



document.addEventListener('DOMContentLoaded', function () {
    fetch('get_user_data.php') 
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Populate the input fields with user data
                document.querySelector('input[name="firstname"]').value = data.user.firstname;
                document.querySelector('input[name="lastname"]').value = data.user.lastname;
                document.querySelector('input[name="address"]').value = data.user.address;
                document.querySelector('input[name="email"]').value = data.user.email;
            } else {
                alert('Failed to load user data.'); // Handle error
            }
        })
        .catch(error => console.error('Error fetching user data:', error));
});

// Show the modal when clicking "Edit Profile"
document.getElementById('editProfileBtn').addEventListener('click', function () {
    document.getElementById('editProfileModal').style.display = 'flex';
});

// Close the modal when clicking the close button
document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('editProfileModal').style.display = 'none';
});

// Handle form submission for profile editing
document.getElementById('editProfileForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission
    var formData = new FormData(this); // Create FormData object from the form

    // Send form data to PHP using AJAX
    fetch('update_profile.php', {
        method: 'POST',
        body: formData // Attach the form data to the request
    })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        if (data.success) {
            alert('Profile updated successfully!'); // Success message
            document.getElementById('editProfileModal').style.display = 'none'; // Close the modal
        } else {
            alert('Error: ' + (data.error || 'Failed to update profile.')); // Error message
        }
    })
    .catch(error => {
        console.error('Error:', error); // Log any errors to the console
        alert('Error updating profile.'); // Display error message
    });
});
</script>

</body>

</html>
