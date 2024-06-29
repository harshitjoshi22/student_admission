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
$sql = "SELECT s.*, a.*, q.*
        FROM students s
        LEFT JOIN addresses a ON s.id = a.student_id
        LEFT JOIN qualifications q ON s.id = q.student_id
        WHERE s.id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "No record found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Print Application</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Print Styles */
        @media print {
            body {
                background-color: white;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            header, .print-button {
                display: none;
            }

            .application-details {
                border: none;
                box-shadow: none;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        header h1 {
            margin: 0;
        }

        .application-details {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .personal-details {
            display: flex;
            justify-content: space-between;
        }

        .details {
            flex: 1;
        }

        .photograph {
            max-width: 200px;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            padding: 5px;
            margin-left: 20px;
            align-self: flex-start;
        }

        h2 {
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: #333;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
        }

        strong {
            color: #4CAF50;
        }

        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div id="branding">
                <h1>Student Application Details</h1>
            </div>
        </header>
        <div class="application-details">
            <div class="personal-details">
                <div class="details">
                    <h2>Personal Details</h2>
                    <p><strong>Name:</strong> <?php echo $student['first_name'] . ' ' . $student['last_name']; ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo $student['dob']; ?></p>
                    <p><strong>Gender:</strong> <?php echo $student['gender']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $student['phone']; ?></p>
                    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
                    <p><strong>Class:</strong> <?php echo $student['class']; ?></p>
                    <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
                </div>
                <?php if ($student['photograph']): ?>
                    <img src="uploads/<?php echo $student['photograph']; ?>" alt="Photograph" class="photograph">
                <?php else: ?>
                    <p>No photograph available.</p>
                <?php endif; ?>
            </div>

            <h2>Address Details</h2>
            <p><strong>Street Address:</strong> <?php echo $student['street_address']; ?></p>
            <p><strong>City:</strong> <?php echo $student['city']; ?></p>
            <p><strong>State:</strong> <?php echo $student['state']; ?></p>
            <p><strong>Postal Code:</strong> <?php echo $student['postal_code']; ?></p>
            <p><strong>Country:</strong> <?php echo $student['country']; ?></p>

            <h2>Qualification Details</h2>
            <p><strong>Qualification Name:</strong> <?php echo $student['qualification_name']; ?></p>
            <p><strong>Institution:</strong> <?php echo $student['institution']; ?></p>
            <p><strong>Year of Passing:</strong> <?php echo $student['year_of_passing']; ?></p>
            <p><strong>Percentage:</strong> <?php echo $student['percentage']; ?></p>
        </div>
        <button class="print-button" onclick="window.print()">Print Application</button>
    </div>
</body>
</html>
