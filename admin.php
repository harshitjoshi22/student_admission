<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style1.css">
    <script src="admin_script.js" defer></script> <!-- Add this line -->
</head>
<body>
    <h1>Admin Panel</h1>
    
    <form action="admin.php" method="get" id="searchForm">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?php echo $search_query; ?>">
        <input type="submit" value="Search">
    </form>
    
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Class</th>
            <th>Course</th>
            <th>Date of Admission</th>
            <th>Photograph</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['class']}</td>
                        <td>{$row['course']}</td>
                        <td>{$row['date_of_admission']}</td>
                        <td><img src='uploads/{$row['photograph']}' width='50' height='50'></td>
                        <td>
                            <a href='approve.php?id={$row['student_id']}' class='btn'>Approve</a>
                            <a href='edit.php?id={$row['student_id']}' class='btn'>Edit</a>
                            <a href='delete.php?id={$row['student_id']}' class='btn'>Delete</a>
                            <a href='print.php?id={$row['student_id']}' class='btn'>Print</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

