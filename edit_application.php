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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name', dob='$dob', gender='$gender', phone='$phone', email='$email', class='$class', course='$course' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Application</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div class="container">
        <header>
            <div id="branding">
                <h1>Edit Application</h1>
            </div>
        </header>
        <form method="post">
            First Name: <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>" required><br>
            Last Name: <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>" required><br>
            Date of Birth: <input type="date" name="dob" value="<?php echo $student['dob']; ?>" required><br>
            Gender: <input type="text" name="gender" value="<?php echo $student['gender']; ?>" required><br>
            Phone: <input type="text" name="phone" value="<?php echo $student['phone']; ?>" required><br>
            Email: <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>
            Class: <input type="text" name="class" value="<?php echo $student['class']; ?>" required><br>
            Course: <input type="text" name="course" value="<?php echo $student['course']; ?>" required><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
