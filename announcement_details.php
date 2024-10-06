<?php
include 'conect.php'; // Include the database connection

// Get the announcement ID from the URL
$announcement_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the announcement details from the database
$sql = "
    SELECT 
        a.AnnouncementID, 
        a.Title, 
        a.CategoryID, 
        a.PostedDate, 
        a.AttachmentPath, 
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
    WHERE 
        a.AnnouncementID = $announcement_id
";

$result = $conn->query($sql);
$announcement = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcement Details</title>
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
        .announcement-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .announcement-meta {
            color: #777;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .attachment {
            margin-top: 20px;
        }
        .attachment a {
            color: #0078D4;
            text-decoration: none;
        }
        .attachment a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($announcement): ?>
            <h1 class="announcement-title"><?php echo htmlspecialchars($announcement['Title']); ?></h1>
            <div class="announcement-meta">
                Posted by <?php echo htmlspecialchars($announcement['PostedBy']); ?> on <?php echo htmlspecialchars($announcement['PostedDate']); ?>
                <br>Category: <?php echo htmlspecialchars($announcement['CategoryName']); ?>
            </div>
            
            <div class="announcement-content">
                <p><?php echo "maelezo kuhusu matangazo ni hapa"; // You can add more details if available ?></p>
            </div>

            <?php if (!empty($announcement['AttachmentPath'])): ?>
                <div class="attachment">
                    <p>Attachment:</p>
                    <a href="<?php echo htmlspecialchars($announcement['AttachmentPath']); ?>" target="_blank">
                        View Attachment
                    </a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h1>No Announcement Found</h1>
            <p>The announcement you are looking for does not exist.</p>
        <?php endif; ?>
    </div>
</body>
</html>
