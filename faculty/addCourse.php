<?php
session_start();
require "../lib/database.php";
require "../lib/constants.php";
require "../lib/loginStatus.php";

$conn = connect_to_database();
$uid = $_SESSION["uid"];
$email = $uid."@buffalo.edu";
$active = 1;

if (!is_logged_in()) {
  header("Location: /CSE442-542/2021-Summer/cse-442c/login.php");
  exit();
}

// Check that the user is a professor.
$sql = $conn->prepare("SELECT * FROM registered_users WHERE email=? and faculty=?");
$sql->bind_param('si', $email, $active);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);

if ($count == 0) {
    http_response_code(403);
    echo "Request forbidden: User is not a professor";
    exit();
}

// Get row data
$course = trim($_POST['course']);
$class_name = trim($_POST['class_name']);
$length = trim($_POST['length']);
$location = trim($_POST['location']);
$message = "Welcome to ".$class_name."!";

$stmt_add_course = $conn->prepare("INSERT INTO staff_list (staff_list_id, email, course) VALUES (NULL,?,?)");
$stmt_add_course->bind_param('ss', $email, $course);
$add_success = $stmt_add_course->execute();
if (!$add_success) {
  return FALSE;
}
$stmt_add_course = $conn->prepare("INSERT INTO courses (course, class_name, active, display_message, default_length, default_location) VALUES (?,?,1,?,?,?)");
$stmt_add_course->bind_param('sssis', $course, $class_name, $message, $length, $location);
$add_success = $stmt_add_course->execute();
if (!$add_success) {
   $_SESSION['status'] = "err";
} else {
   $_SESSION['status'] = "add_course_succ";
}

header("Location: ../start.php");
?>