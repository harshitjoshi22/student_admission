<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_admission";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get personal details
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Get address details
$street_address = $_POST['street_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$postal_code = $_POST['postal_code'];
$country = $_POST['country'];

// Get class/course details
$class = $_POST['class'];
$course = $_POST['course'];

// Get previous qualifications
$qualification_name = $_POST['qualification_name'];
$institution = $_POST['institution'];
$year_of_passing = $_POST['year_of_passing'];
$percentage = $_POST['percentage'];

// Get photograph
$photograph = $_FILES['photograph']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["photograph"]["name"]);

if (move_uploaded_file($_FILES["photograph"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["photograph"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Insert data into students table
$sql = "INSERT INTO students (first_name, last_name, dob, gender, phone, email, class, course, date_of_admission, photograph)
VALUES ('$first_name', '$last_name', '$dob', '$gender', '$phone', '$email', '$class', '$course', CURDATE(), '$photograph')";

if ($conn->query($sql) === TRUE) {
    $student_id = $conn->insert_id;

    // Insert data into addresses table
    $sql_address = "INSERT INTO addresses (student_id, street_address, city, state, postal_code, country)
    VALUES ('$student_id', '$street_address', '$city', '$state', '$postal_code', '$country')";
    $conn->query($sql_address);

    // Insert data into qualifications table
    $sql_qualification = "INSERT INTO qualifications (student_id, qualification_name, institution, year_of_passing, percentage)
    VALUES ('$student_id', '$qualification_name', '$institution', '$year_of_passing', '$percentage')";
    $conn->query($sql_qualification);

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
