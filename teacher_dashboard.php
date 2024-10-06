<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=not_logged_in");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1F51FF;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: white;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            padding: 20px;
            border: 3px solid #0078d4;
            border-radius: 15px;
            margin-top: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
        }

        .sidebar ul li:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(31, 81, 255, 0.5);
        }

        .sidebar ul li a {
            color: black;
            text-decoration: none;
            display: block;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f4f4f4;
            min-height: 100vh;
        }

        #content {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Announcement Slider Styling */
        .kontena {
            padding: 2rem;
        }
        .slider-wrapper {
            position: relative;
            max-width: 48rem;
            margin: 0 auto;
        }
        .slider {
            display: flex;
            aspect-ratio: 16/9;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            box-shadow: 0 1.5rem 3rem -0.75rem hsla(0, 0%, 0%, 0.25);
            border-radius: 0.5rem;
        }
        .slider img {
            flex: 1 0 100%;
            scroll-snap-align: start;
            object-fit: cover;
        }
        .slider-nav {
            display: flex;
            column-gap: 1rem;
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }
        .slider-nav a {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #fff;
            opacity: 0.75;
            transition: opacity ease 250ms;
        }
        .slider-nav a:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="admindashboard.php">Enter as Admin</a></li>
            <li><a href="regsubject.php">Register Subject</a></li>
            <li><a href="post_announcement.php">Post Announcement</a></li>
            <li><a href="service.php">Self Service</a></li>
            <li><a href="updatepassword.php">Change Password</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
        <h2>Your Details</h2>
        <p>Email: <?php echo $_SESSION['teacher_email']; ?></p>
        <p>Phone: <?php echo $_SESSION['teacher_phone']; ?></p>
        <p>Gender: <?php echo $_SESSION['teacher_gender']; ?></p>
        <p><strong>Department:</strong> <?php echo $_SESSION['teacher_department_name']; ?></p>
        <h1>THE DASHBOARD</h1>

        <div id="content">
            <h1>WHAT'S NEW</h1>
               
            <!-- Announcement Slider -->
            <section class="kontena">
                <div class="slider-wrapper">
                    <div class="slider">
                        <img id="image1" src="frozentundra.png" alt="without bars and stripes you look like frozen sh*t general"/>
                        <img id="image2" src="reconbyfire.png" alt="bravo how copy, ....solid watcher two down"/>
                        <img id="image3" src="makr.png" alt="and this is ghost team, no 141 or las varqueros, your in, take the mask is not."/>
                    </div>
                    <div class="slider-nav">
                        <a href="#image1"></a>
                        <a href="#image2"></a>
                        <a href="#image3"></a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
