<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "members";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form inputs and sanitize them
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Define the SQL query to validate credentials
    $stmt = "SELECT * FROM users WHERE username = '$user' AND password = '$pass' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $stmt);

    // Check if credentials are correct
    if (mysqli_num_rows($result) > 0) {
        // Start session and store user info
        session_start();
        $_SESSION['username'] = $user;
        $_SESSION['user_id'] = $user_id;

        // Redirect to dashboard
        header("Location: dashboard.html");
        exit();
    } else {
        echo "<p style='color: red;'>Invalid credentials, please try again.</p>";
    }

    // Close the connection
    mysqli_close($conn);
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NextHire</title>
    <style>
        /* Basic resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Login container */
        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header */
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #3bb9ff;
        }

        /* Input fields */
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Submit button */
        .login-container input[type="submit"] {
            background-color: #3bb9ff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .login-container input[type="submit"]:hover {
            background-color: #1f7fb8;
        }

        /* Small text below */
        .login-container p {
            margin-top: 15px;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form action="dashboard.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="user_id" placeholder="User ID" required>
        <input type="submit" value="Login">
    </form>
    <p>Don’t have an account? <a href="signup.html">Sign up</a></p>
</div>

</body>
</html>
