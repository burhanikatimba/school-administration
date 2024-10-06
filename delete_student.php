<?php
include 'conect.php'; // Include the database connection

$student_id = $_GET['id'];

// Delete the student
$sql = "DELETE FROM Students WHERE UserID = '$student_id'";
if ($conn->query($sql) === TRUE) {
    echo "Student deleted successfully!";
} else {
    echo "Error deleting student: " . $conn->error;
}
?>
