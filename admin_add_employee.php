<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="assets/font/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        /** Sidebar all **/
        .sidebar {
            width: 170px;
            height: 100%;
            background-color: #c39fc3;
            position: fixed;
            left: 0;
            top: 0;
            border: 0.1px solid gray;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
              
        /** Content for the page **/
        .content {
            margin-left: 170px;
            padding: 1px 20px;
            background-color: #f4f1f8;
            min-height: 100vh;
        }

        .header > p {
            font-size: 2rem;
            color: #333;
        }

        /* Form container for 3-row, 3-column layout */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 20px auto;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="text"], 
        .form-container input[type="email"],
        .form-container input[type="number"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-container .form-row .form-column {
            width: 32%;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #45a049;
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

            .form-container .form-row {
                flex-direction: column;
            }

            .form-container .form-column {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <br>
        <h2><span style="color: #ffff;">Blue</span><span>Market</span></h2>
        <a href="#"><i class="fa fa-home"></i> Dashboard</a>
        <a href="#"><i class="fa fa-users"></i> Employees</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <a href="index.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
    
    <!-- Navbar -->
    <div class="navbar" id="navbar">
        <a href="#" title="Dashboard"><i class="fa fa-home"></i></a>
        <a href="#" title="Employees"><i class="fa fa-users"></i></a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </div>
    
    <!-- Content -->
    <div class="content">
        <div class="header">
            <p>Dashboard</p>
        </div>
        
        <div class="form-container">
            <h2>Add Employee</h2>
            <form action="insert_employee.php" method="POST">
                <div class="form-row">
                    <div class="form-column">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-column">
                        <label for="middlename">Middle Name</label>
                        <input type="text" id="middlename" name="middlename">
                    </div>
                    <div class="form-column">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <div class="form-column">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" required>
                    </div>
                    <div class="form-column">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-column">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-column"></div> <!-- Empty column for spacing -->
                </div>

                <button type="submit">Add Employee</button>
            </form>
        </div>
    </div>
    
    <script>
        // JavaScript can be added here if needed
    </script>
</body>
</html>
