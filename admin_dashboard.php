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

$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM students WHERE CONCAT(first_name, ' ', last_name) LIKE '%$search%' OR date_of_admission LIKE '%$search%' OR phone LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        form {
            margin: 20px 0;
        }

        input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: black;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            margin: 2px;
        }

        .btn-approve {
            background-color: #4CAF50;
        }

        .btn-edit {
            background-color: #FFA500;
        }

        .btn-delete {
            background-color: #F44336;
        }

        .btn-view {
            background-color: #2196F3;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* New style for logout button */
        .logout-btn {
    text-align: center;
    margin-top: 20px;
}

.logout-btn a {
    padding: 6px 10px; /* Adjust padding as needed */
    background-color: yellow; /* Grey background color */
    color: black; /* White text color */
    text-decoration: none; /* Remove underline */
    border-radius: 10px; /* Rounded corners */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
    font-weight: bold;
    font-size: large;
}

.logout-btn a:hover {
    background-color: pink; /* Darker grey on hover */
}

    </style>
</head>
<body>
    <div class="container">
        <header>
            <div id="branding">
                <h1>Admin Dashboard</h1>
            </div>
            <nav>
                <ul>
                    <li class="logout-btn"> <a class="btn btn-logout" href="logout.php">Logout</a></li>
                </ul>
            </nav>
            
        </header>
        <form method="get">
            Search: <input type="text" name="search" placeholder="Name, Date of Admission, Phone">
            <input type="submit" value="Search">
        </form>
        <h2>Applications</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date of Admission</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Class</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                <td><?php echo $row['date_of_admission']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td>
                    <a class="btn btn-approve" href="approve_application.php?id=<?php echo $row['id']; ?>">Approve</a>
                    <a class="btn btn-edit" href="edit_application.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="btn btn-delete" href="delete_application.php?id=<?php echo $row['id']; ?>">Delete</a>
                    <a class="btn btn-view" href="view_application.php?id=<?php echo $row['id']; ?>" target="_blank">View</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <!-- Logout button positioned at the bottom -->
      
    </div>

    
</body>
</html>

<?php
$conn->close();
?>
