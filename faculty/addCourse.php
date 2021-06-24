<?php
session_start();
require "../lib/database.php";
require "../lib/constants.php";
require "../lib/loginStatus.php";
require "lib/add_to_database.php";

$conn = connect_to_database();
$uid = $_SESSION["uid"];
$email = $uid."@buffalo.edu";

if (!is_logged_in()) {
  header("Location: /CSE442-542/2021-Summer/cse-442c/login.php");
  exit();
}

// Check that the user is a professor.
$sql = $conn->prepare("SELECT * FROM registered_users WHERE email=? AND faculty=?");
$sql->bind_param('si', $email, 1);
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
$addedCourse = addCourse($conn, $email, $course, $class_name, $length, $location);
if (!$addedCourse) {
  $_SESSION['status'] = "err";
} else {
  $_SESSION['status'] = "add_succ";
}
header("Location: ./facultyManage.php");
?>