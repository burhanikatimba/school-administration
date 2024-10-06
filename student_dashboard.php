<?php
// Start the session to retrieve student information
session_start();

// Redirect if the user is not logged in or not a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: login.php');
    exit();
}

// Get the student details from the session
$student_name = $_SESSION['user_name'];
$student_email = $_SESSION['student_email'];
$student_phone = $_SESSION['student_phone'];
$student_gender = $_SESSION['student_gender'];
$student_department = $_SESSION['student_department_name'];
$student_course = $_SESSION['student_course_name'];
$student_class = $_SESSION['student_class_name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
            <li><a href="view_grades.php">View Grades</a></li>
            <li><a href="register_courses.php">Register Courses</a></li>
            <li><a href="view_announcement.php">View Announcements</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Student Dashboard</h1>

        <div id="content">
            <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>

            <p><strong>Email:</strong> <?php echo isset($_SESSION['student_email']) ? $_SESSION['student_email'] : 'N/A'; ?></p>
            <p><strong>Phone:</strong> <?php echo isset($_SESSION['student_phone']) ? $_SESSION['student_phone'] : 'N/A'; ?></p>
            <p><strong>Gender:</strong> <?php echo isset($_SESSION['student_gender']) ? $_SESSION['student_gender'] : 'N/A'; ?></p>
            <p><strong>Department:</strong> <?php echo isset($_SESSION['student_department_name']) ? $_SESSION['student_department_name'] : 'N/A'; ?></p>
            <p><strong>Course:</strong> <?php echo isset($_SESSION['student_course_name']) ? $_SESSION['student_course_name'] : 'Course not assigned'; ?></p>
            <p><strong>Class:</strong> <?php echo isset($_SESSION['student_class_name']) ? $_SESSION['student_class_name'] : 'Class not assigned'; ?></p>
        </div>

        <!-- Announcement Slider -->
      

<section class="kontena">
    <div class="slider-wrapper">
        <div class="slider">
            <?php
            include 'conect.php'; // Include database connection

            // Fetch announcements
            $sql = "SELECT * FROM Announcements ORDER BY PostedDate DESC LIMIT 3"; // Fetch latest 3 announcements
            $result = $conn->query($sql);

            while ($announcement = $result->fetch_assoc()) {
                if ($announcement['AttachmentType'] == 'image') {
                    echo "<img src='" . $announcement['AttachmentPath'] . "' alt='" . $announcement['Title'] . "' />";
                } elseif ($announcement['AttachmentType'] == 'pdf') {
                    echo "<img src='pdf_thumbnail.png' alt='" . $announcement['Title'] . "' />"; // Display placeholder for PDFs
                }
            }
            ?>
        </div>
        <div class="slider-nav">
            <a href="#image1"></a>
            <a href="#image2"></a>
            <a href="#image3"></a>
        </div>
    </div>
</section>


    </div>
</body>
</html>
