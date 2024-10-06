<?php
include 'conect.php'; // Include the database connection

// Get form data
$teacherid = $_POST['teacherid'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$department_name = $_POST['department'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];

// Fetch department ID
$department_id_result = $conn->query("SELECT DepartmentID FROM Departments WHERE DepartmentName = '$department_name'");
if ($department_id_result && $department_id_result->num_rows > 0) {
    $department_id = $department_id_result->fetch_assoc()['DepartmentID'];
} else {
    die("Department not found.");
}

// Insert data into Users table and get UserID
$sql = "INSERT INTO Users (Username,Password, RoleID) VALUES ('$last_name','$password', 2)"; // RoleID 2 for teacher
if ($conn->query($sql) === TRUE) {
    $user_id = $conn->insert_id; // Get the inserted UserID

    // Insert data into Teachers table
    $sql = "INSERT INTO Teachers (TeacherID,UserID, FirstName, LastName, Email, Phone, Gender, DepartmentID)
            VALUES ('$teacherid','$user_id', '$first_name', '$last_name', '$email', '$phone', '$gender', '$department_id')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error inserting into Users: " . $conn->error;
}

$conn->close();
?>
