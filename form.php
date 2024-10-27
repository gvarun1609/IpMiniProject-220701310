<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
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
    // Handle file upload
    $resume=$_FILES['resume'];
    $resumeName = basename($resume['name']); // Get the file name
    $targetDirectory = "C:\Users\gvaru\Downloads\ip mini project\\varun nexthire\local\\"; 
    // Insert data into database
    // $stmt = "insert into jobapplications (name, email, position) VALUES ('$name','$email','$position')";
    $targetFilePath = $targetDirectory . $resumeName;
    //Move the uploaded file to the target directory
    if (move_uploaded_file($resume['tmp_name'], $targetFilePath)) {
        // Insert data into the database (only the file name is saved)
        $stmt = "INSERT INTO jobapplications (name, email, position, resume) VALUES ('$name', '$email', '$position', '$resumeName')";


    if ($conn->query($stmt)) {
        echo "<p style='color: green;'>Your application has been submitted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

     //$stmt->close();
} else {
    echo "<p style='color: red;'>Error uploading resume file. Please try again.</p>";
    }
    $conn->close();
}
?>


    <section class="form-section">
        <h2>Apply for this Job</h2>
        <form id="job-form" action="form.php" method="post" enctype="multipart/form-data">
        
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="position">Position Applying For:</label>
            <input type="text" id="position" name="position" value="Data Analytics" readonly>

            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume" accept=".pdf, .docx" required>

            <button type="submit" class="apply-btn">Submit Application</button>
        </form>
    </section>

    <footer>
        <p>NextHire &copy; 2024. All rights reserved.</p>
    </footer>

    <script>
        // Show a success message when the form is submitted
       // document.getEleentById('job-form').addEventListener('submit', function(event) {
       //     event.preventDefault();
        //    alert('Your application has been submitted successfully!');
        //});
    </script>


