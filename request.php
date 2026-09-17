<?php
require_once "config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$name = trim($_POST['student_name']);
$email = trim($_POST['student_email']);
$faculty_id = (int)$_POST['faculty_id'];
$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];
$purpose = trim($_POST['purpose']);

// Get faculty name using faculty ID
$faculty_stmt = $conn->prepare("SELECT name FROM faculty WHERE id = ?");
$faculty_stmt->bind_param("i", $faculty_id);
$faculty_stmt->execute();
$faculty_result = $faculty_stmt->get_result();

if ($faculty_result->num_rows === 0) {
    header("Location: index.php?msg=Invalid faculty selected.");
    exit;
}

$faculty = $faculty_result->fetch_assoc()['name'];

// Insert appointment
$stmt = $conn->prepare("INSERT INTO appointments 
(student_name, student_email, faculty_name, appointment_date, appointment_time, reason) 
VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", $name, $email, $faculty, $date, $time, $purpose);

if ($stmt->execute()) {
    header("Location: index.php?msg=Request submitted successfully.");
} else {
    header("Location: index.php?msg=Unable to submit request. Please try again.");
}

exit;
?>