<?php
$user_role = $_POST['user_role'];

if ($user_role == 'teacher') {
    header('Location: teacher_form.php');
} elseif ($user_role == 'student') {
    header('Location: student_form.php');
} else {
    echo "Invalid role selected.";
}
exit();
?>
