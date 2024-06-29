<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_admission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $course = $_POST['course'];
    $date_of_admission = date('Y-m-d');
    $photograph = $_FILES['photograph']['name'];
    
    // Upload photograph
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photograph"]["name"]);
    move_uploaded_file($_FILES["photograph"]["tmp_name"], $target_file);

    // Insert data into 'students' table
    $sql = "INSERT INTO students (first_name, last_name, dob, gender, phone, email, class, course, date_of_admission, photograph)
            VALUES ('$first_name', '$last_name', '$dob', '$gender', '$phone', '$email', '$class', '$course', '$date_of_admission', '$photograph')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
