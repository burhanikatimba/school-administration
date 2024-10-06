<?php
include 'conect.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Windows 11 Inspired Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 40px;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin: 40px auto;
            max-width: 800px;
        }

        .main-content h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #333;
        }

        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .button-container a {
            padding: 15px 25px;
            background-color: #0078D4;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .button-container a:hover {
            background-color: #005a9e;
        }

        .logout-container {
            text-align: right;
            margin-top: 20px;
        }

        .logout-container a {
            padding: 10px 20px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .logout-container a:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome, Admin</h1>
        <div class="button-container">
            <a href="view_student.php">View Student List</a>
            <a href="post_announcement.php">Post Announcement</a>
        </div>

        <!-- Logout Button -->
        <div class="logout-container">
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</body>
</html>
