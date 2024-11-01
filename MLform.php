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

        @keyframes growLine {
            0% {
                width: 0;
            }
            100% {
                width: 30px;
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
        <h2>ML Expert - Job Description</h2>
        <p class="job-desc">
            We are looking for a highly skilled ML engineer to join our team.
            You will be responsible for designing and implementing new systems and applications,
            troubleshooting issues, and ensuring all software is up-to-date.
        </p>
        <p class="job-desc">
            If you're passionate about coding, solving complex problems, and working in a dynamic environment,
            we would love to have you on board. Submit your resume below to apply!
        </p>
    </section>

    <?php
    include "form.php";
    ?>

    <script>
        // Show a success message when the form is submitted
        document.getElementById('job-form').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Your application has been submitted successfully!');
        });
    </script>
</body>
</html>

