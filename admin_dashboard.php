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
        
        <p></p>
    </div>
    
    <script>
        
    </script>
</body>
</html>
