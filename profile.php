<?php
// Database configuration
$servername = "localhost"; // Change if needed
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "members"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume user_id is retrieved from the session or authentication system
session_start();
$user_id = $_SESSION['user_id']; // Replace with actual user ID

// Retrieve job applications for the logged-in user
$sql = "SELECT position FROM jobapplications WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h1 {
            color: #3bb9ff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #3bb9ff;
            color: white;
        }
    </style>
</head>
<body>

<h1>Your Job Applications</h1>

<table>
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Company Name</th>
            <th>Application Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are results
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['job_title']) . "</td>
                    
                        <td>" . htmlspecialchars($row['application_date']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No applications found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>

</body>
</html>
