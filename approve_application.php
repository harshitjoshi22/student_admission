<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'student_admission');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "UPDATE students SET approved = 1 WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: print_application.php?id=$id");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

