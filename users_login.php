<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <style>
     body {
    background-color: #d3d3d3; 
    font-family: 'Open Sans', sans-serif;
    color: #4c4c4c;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 350px; 
    padding: 20px;
    background-color: #ebebeb; 
    border-radius: 8px; 
    box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
    border: solid 1px #cbc9c9;
}


        input[type=text], input[type=password] {
            width: 96.5%; 
            height: 39px; 
            border-radius: 4px; 
            background-color: #fff; 
            border: solid 1px #cbc9c9;
            margin-bottom: 20px; 
            padding-left: 10px;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
        }

        a.button {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #3a57af; 
            color: white;
            border-radius: 5px; 
            text-decoration: none; 
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #2e458b;
        }

        .signup {
            text-align: center;
            margin-top: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">Blue Market
        <form action="/">
            <h2>Login</h2>
            <label for="email"><i class="icon-envelope"></i> Email:</label>
            <input type="text" name="email" id="email" placeholder="Email" required />
            <label for="password"><i class="icon-shield"></i> Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required />
            <a href="#" class="button">Login</a>
        </form>
        <div class="signup">
            <p>Don't have an account? <a href="#">Sign up</a></p>
        </div>
    </div>
</body>
</html>
