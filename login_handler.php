<?php
// Include the database connection
include 'conect.php';

// Get form data
$email = $_POST['email'];
$last_name = $_POST['last_name'];
$user_role = $_POST['user_role']; // Either 'student' or 'teacher'

// Validate user role
if ($user_role == 'student') {
    // Check in Students table
    $sql = "SELECT * FROM Students WHERE Email = ? AND LastName = ?";
} elseif ($user_role == 'teacher') {
    // Check in Teachers table
    $sql = "SELECT * FROM Teachers WHERE Email = ? AND LastName = ?";
} else {
    echo "Invalid role selected.";
    exit();
}

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $last_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Credentials are correct, fetch user data
    $user_data = $result->fetch_assoc();
    
    // Start session and store user data as needed
    session_start();
    $_SESSION['user_id'] = $user_data['UserID'];
    $_SESSION['user_role'] = $user_role;
    $_SESSION['user_name'] = $user_data['FirstName'] . ' ' . $user_data['LastName'];

    // If the user is a teacher, fetch teacher details
    if ($user_role == 'teacher') {
        $teacher_id = $user_data['TeacherID'];
        
        // Fetch teacher details
        $teacher_details_sql = "SELECT * FROM Teachers WHERE TeacherID = ?";
        $teacher_stmt = $conn->prepare($teacher_details_sql);
        $teacher_stmt->bind_param("s", $teacher_id);
        $teacher_stmt->execute();
        $teacher_result = $teacher_stmt->get_result();

        if ($teacher_result->num_rows > 0) {
            $teacher_info = $teacher_result->fetch_assoc();
            $_SESSION['teacher_email'] = $teacher_info['Email'];
            $_SESSION['teacher_phone'] = $teacher_info['Phone'];
            $_SESSION['teacher_gender'] = $teacher_info['Gender'];

            // Fetch department name
            $department_name_sql = "SELECT DepartmentName FROM Departments WHERE DepartmentID = ?";
            $department_stmt = $conn->prepare($department_name_sql);
            $department_stmt->bind_param("i", $teacher_info['DepartmentID']);
            $department_stmt->execute();
            $department_result = $department_stmt->get_result();

            if ($department_result->num_rows > 0) {
                $department_data = $department_result->fetch_assoc();
                $_SESSION['teacher_department_name'] = $department_data['DepartmentName'];
            }
        }

        // Redirect to the teacher dashboard
        header('Location: teacher_dashboard.php');
    }

    // If the user is a student, fetch student details
    if ($user_role == 'student') {
        $student_id = $user_data['StudentID'];
        
        // Fetch student details
        $student_details_sql = "SELECT * FROM Students WHERE StudentID = ?";
        $student_stmt = $conn->prepare($student_details_sql);
        $student_stmt->bind_param("s", $student_id);
        $student_stmt->execute();
        $student_result = $student_stmt->get_result();

        if ($student_result->num_rows > 0) {
            $student_info = $student_result->fetch_assoc();
            $_SESSION['student_email'] = $student_info['Email'];
            $_SESSION['student_phone'] = $student_info['Phone'];
            $_SESSION['student_gender'] = $student_info['Gender'];

            // Fetch department, course, and class names
            $student_dept_sql = "SELECT DepartmentName FROM Departments WHERE DepartmentID = ?";
            $dept_stmt = $conn->prepare($student_dept_sql);
            $dept_stmt->bind_param("i", $student_info['DepartmentID']);
            $dept_stmt->execute();
            $dept_result = $dept_stmt->get_result();
            if ($dept_result->num_rows > 0) {
                $dept_data = $dept_result->fetch_assoc();
                $_SESSION['student_department_name'] = $dept_data['DepartmentName'];
            }

            $student_course_sql = "SELECT CourseName FROM Courses WHERE CourseID = ?";
            $course_stmt = $conn->prepare($student_course_sql);
            $course_stmt->bind_param("i", $student_info['CourseID']);
            $course_stmt->execute();
            $course_result = $course_stmt->get_result();
            if ($course_result->num_rows > 0) {
                $course_data = $course_result->fetch_assoc();
                $_SESSION['student_course_name'] = $course_data['CourseName'];
            }

            $student_class_sql = "SELECT ClassName FROM Classes WHERE ClassID = ?";
            $class_stmt = $conn->prepare($student_class_sql);
            $class_stmt->bind_param("i", $student_info['ClassID']);
            $class_stmt->execute();
            $class_result = $class_stmt->get_result();
            if ($class_result->num_rows > 0) {
                $class_data = $class_result->fetch_assoc();
                $_SESSION['student_class_name'] = $class_data['ClassName'];
            }
        }

        // Redirect to the student dashboard
        header('Location: student_dashboard.php');
    }
} else {
    // Invalid credentials
    echo "Invalid email or last name.";
}

$stmt->close();
$conn->close();
?>
