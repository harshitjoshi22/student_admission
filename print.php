<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_admission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_GET['id'];

$sql = "SELECT * FROM students WHERE student_id='$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Display student details for printing
    echo "<h1>Student Admission Form</h1>";
    echo "First Name: " . $row['first_name'] . "<br>";
    echo "Last Name: " . $row['last_name'] . "<br>";
    echo "Date of Birth: " . $row['dob'] . "<br>";
    echo "Gender: " . $row['gender'] . "<br>";
    echo "Phone: " . $row['phone'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "Class: " . $row['class'] . "<br>";
    echo "Course: " . $row['course'] . "<br>";
    echo "Date of Admission: " . $row['date_of_admission'] . "<br>";
    echo "<img src='uploads/" . $row['photograph'] . "' width='100' height='100'><br>";
} else {
    echo "No record found";
}

$conn->close();
?>
