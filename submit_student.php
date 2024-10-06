<?php
include 'conect.php'; // Include the database connection

// Get form data


    $studentid = $_POST['studentid'];
    $first_name = $_POST['first_name'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $phone = $_POST['Phone'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $course = $_POST['course'];
    $Class = $_POST['Class'];

    // Insert data into the Users table and get the UserID
    $sql = "INSERT INTO Users (Username,Password, RoleID) VALUES ('$last_name','$password', 1)"; // Assuming RoleID 1 for student
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id; // Get the inserted UserID
        
        // Insert data into the Students table
        $sql = "INSERT INTO Students (StudentID,UserID, FirstName, LastName, Email, Phone, Gender,  DepartmentID, CourseID, ClassID)
                VALUES ('$studentid','$user_id', '$first_name', '$last_name', '$email','$phone', '$gender',  
                (SELECT DepartmentID FROM Departments WHERE DepartmentName = '$department'), 
                (SELECT CourseID FROM Courses WHERE CourseName = '$course'),(SELECT ClassID FROM classes WHERE ClassName = '$Class'))";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }
$conn->close();
?>




