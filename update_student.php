<?php
include 'conect.php'; // Include the database connection

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the student data by joining the Students and Users tables
    $sql = "SELECT s.*, u.UserID FROM Students s 
            JOIN Users u ON s.UserID = u.UserID 
            WHERE u.UserID = '$user_id'";
    $result = $conn->query($sql);
    
    // Check if the student exists
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        die("Error retrieving student's information. No records found for UserID: $user_id");
    }
} else {
    die("Error: User ID not provided.");
}

// Update student information when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Update the student information
    $sql = "UPDATE Students SET FirstName = '$first_name', LastName = '$last_name', Email = '$email' WHERE UserID = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='message'>Student information updated successfully!</div>";
    } else {
        echo "<div class='message'>Error updating student: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0078d4;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005bb5;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: green;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Student</h1>
        <form method="POST">
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo isset($student['FirstName']) ? $student['FirstName'] : ''; ?>" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo isset($student['LastName']) ? $student['LastName'] : ''; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo isset($student['Email']) ? $student['Email'] : ''; ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
