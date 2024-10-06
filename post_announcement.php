<?php
include 'conect.php'; // Database connection

session_start(); // Start the session
$posted_by = $_SESSION['user_id']; // Retrieve the UserID from session

// Retrieve teacher's name
$sql = "
    SELECT 
        t.FirstName, 
        t.LastName 
    FROM 
        Teachers t 
    JOIN 
        Users u ON t.UserID = u.UserID 
    WHERE 
        u.UserID = '$posted_by'
";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $teacher = $result->fetch_assoc();
    $teacher_name = $teacher['FirstName'] . ' ' . $teacher['LastName'];
} else {
    echo "Error retrieving teacher's information.";
    exit; // Stop the script if teacher info can't be retrieved
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category_id = $_POST['category'];
    $posted_date = date('Y-m-d H:i:s');
    
    // Handle file upload
    $attachment_path = '';
    $attachment_type = '';
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $attachment_path = 'uploads/' . basename($_FILES['attachment']['name']);
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment_path);
        $attachment_type = pathinfo($attachment_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image';
    }

    // Insert announcement
    $sql = "INSERT INTO Announcements (Title, CategoryID, PostedBy, PostedDate, AttachmentPath, AttachmentType)
            VALUES ('$title', '$category_id', '$posted_by', '$posted_date', '$attachment_path', '$attachment_type')";

    if ($conn->query($sql) === TRUE) {
        echo "Announcement posted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Announcement</title>
    <style>
        /* Styling similar to Windows 11 for form */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #0078D4;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005a9e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Post an Announcement</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>

            <label for="category">Category</label>
            <select name="category" id="category" required>
                <option value="1">General</option>
                <option value="2">Urgent</option>
                <option value="3">Event</option>
            </select>

            <label for="attachment">Attachment (Image or PDF)</label>
            <input type="file" name="attachment" id="attachment">

            <button type="submit">Post Announcement</button>
        </form>
    </div>
</body>
</html>
<?php

