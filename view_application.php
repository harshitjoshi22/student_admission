<?php
$conn = new mysqli('localhost', 'root', '', 'student_admission');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Application</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            position: relative;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

        p strong {
            color: #333;
        }

        .photograph {
            position: absolute;
            top: 100px;
            right: 50px;
            text-align: center;
        }

        .photograph img {
            border-radius: 8px;
            max-width: 150px;
            display: block;
            margin: 0 auto;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Application Details</h1>
        <p><strong>Name:</strong> <?php echo $student['first_name'] . ' ' . $student['last_name']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $student['dob']; ?></p>
        <p><strong>Gender:</strong> <?php echo $student['gender']; ?></p>
        <p><strong>Phone:</strong> <?php echo $student['phone']; ?></p>
        <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
        <p><strong>Class:</strong> <?php echo $student['class']; ?></p>
        <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
        <p><strong>Date of Admission:</strong> <?php echo $student['date_of_admission']; ?></p>
        <div class="photograph">
            <img src="uploads/<?php echo $student['photograph']; ?>" alt="Photograph">
        </div>
        <button class="btn" onclick="window.print()">Print</button>
    </div>
</body>
</html>



