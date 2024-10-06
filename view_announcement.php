<?php
include 'conect.php'; // Include the database connection

// Fetch announcements from the database
$sql = "
    SELECT 
        a.AnnouncementID, 
        a.Title, 
        a.PostedDate, 
        ac.CategoryName, 
        CONCAT(t.FirstName, ' ', t.LastName) AS PostedBy 
    FROM 
        Announcements a 
    JOIN 
        AnnouncementCategories ac ON a.CategoryID = ac.CategoryID 
    JOIN 
        Users u ON a.PostedBy = u.UserID 
    JOIN 
        Teachers t ON u.UserID = t.UserID 
    ORDER BY 
        a.PostedDate DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Announcements</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .announcement {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }
        .announcement:last-child {
            border-bottom: none;
        }
        .announcement-title {
            font-size: 20px;
            font-weight: bold;
        }
        .announcement-meta {
            color: #777;
            font-size: 14px;
        }
        .view-link {
            text-decoration: none;
            color: #0078D4;
            font-weight: bold;
        }
        .view-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Announcements</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='announcement'>";
                echo "<div class='announcement-title'><a class='view-link' href='announcement_details.php?id=" . $row['AnnouncementID'] . "'>" . $row['Title'] . "</a></div>";
                echo "<div class='announcement-meta'>Posted by " . $row['PostedBy'] . " on " . $row['PostedDate'] . " (Category: " . $row['CategoryName'] . ")</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No announcements found.</p>";
        }
        ?>
    </div>
</body>
</html>
