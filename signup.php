<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "members"; // Database name

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form inputs and sanitize them
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Check if the username or user_id already exists
    $check_user = "SELECT * FROM users WHERE username = '$username' OR user_id = '$user_id'";
    $result = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: red;'>Username or User ID already exists. Please try again with different credentials.</p>";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql = "INSERT INTO users (username, pass, user_id) VALUES ('$username', '$hashed_password', '$user_id')";
        
        if (mysqli_query($conn, $sql)) {
            // Redirect to login page after successful signup
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - NextHire</title>
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

        /* Signup container */
        .signup-container {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header */
        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #3bb9ff;
        }

        /* Input fields */
        .signup-container input[type="text"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Submit button */
        .signup-container input[type="submit"] {
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

        .signup-container input[type="submit"]:hover {
            background-color: #1f7fb8;
        }

        /* Small text below */
        .signup-container p {
            margin-top: 15px;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="user_id" placeholder="User ID" required>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="index.php">Login</a></p>
</div>

</body>
</html>
