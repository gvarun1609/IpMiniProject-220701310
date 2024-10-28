<?php
session_start(); // Start session to access user_id
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "members";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session

    // Handle file upload
    $resume = $_FILES['resume'];
    $resumeName = basename($resume['name']); // Get the file name
    $targetDirectory = "C:\\Users\\gvaru\\Downloads\\ip mini project\\varun nexthire\\local\\"; 
    $targetFilePath = $targetDirectory . $resumeName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($resume['tmp_name'], $targetFilePath)) {
        // Insert data into the database (including user_id)
        $stmt = "INSERT INTO jobapplications (name, email, position, resume, user_id) VALUES ('$name', '$email', '$position', '$resumeName', '$user_id')";

        if ($conn->query($stmt)) {
            echo "<p style='color: green;'>Your application has been submitted successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Error uploading resume file. Please try again.</p>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextHire - Job Application</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f7f9fc;
        }

        .header {
            display: flex;
            justify-content: space-between;
            text-align: center;
            background-color: #36b0e3;
            padding: 20px;
        }

        .animate-header {
            font-size: 36px;
            color: white;
            animation: fadeIn 2s ease-in-out;
        }

        .menu-icon {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu-icon .line {
            width: 30px;
            height: 4px;
            background-color: white;
        }

        .job-section {
            text-align: center;
            padding: 40px;
        }

        .job-section h2 {
            font-size: 28px;
            color: #333;
            animation: slideDown 1s ease;
        }

        .job-desc {
            font-size: 18px;
            color: #090000;
            margin-top: 20px;
            animation: fadeInText 2s;
        }

        .form-section {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: fadeIn 1.5s ease;
        }

        .form-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
            color: #333;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .apply-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #36b0e3;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .apply-btn:hover {
            background-color: #2a91bb;
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            0% {
                transform: translateY(-50px);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes fadeInText {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #f1f1f1;
            color: #777;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1 class="animate-header">NextHire</h1>
        <div class="menu-icon">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </header>

    <section class="job-section">
        <h2>Data Analytics - Job Description</h2>
        <p class="job-desc">
            We are looking for a highly skilled data analytics to join our team.
            You will be responsible for designing and implementing new systems and applications,
            troubleshooting issues, and ensuring all software is up-to-date.
        </p>
        <p class="job-desc">
            If you're passionate about data science, solving complex problems, and working in a dynamic environment,
            we would love to have you on board. Submit your resume below to apply!
        </p>
    </section>

    <section class="form-section">
        <h2>Apply for this Job</h2>
        <form id="job-form" action="dataform.php" method="post" enctype="multipart/form-data">
        
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="position">Position Applying For:</label>
            <input type="text" id="position" name="position" value="Data Analytics" readonly>

            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume" accept=".pdf, .docx" required>

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

            <button type="submit" class="apply-btn">Submit Application</button>
        </form>
    </section>

    <footer>
        <p>NextHire &copy; 2024. All rights reserved.</p>
    </footer>

    <script>
        // Optional: Show a success message when the form is submitted
        // document.getElementById('job-form').addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     alert('Your application has been submitted successfully!');
        // });
    </script>
</body>
</html>
