<!DOCTYPE html>
<html>
<head>
    <title>Student Dues</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Student Dues</h1>

    <form method="GET" action="Regdues.php">
        <label for="roll_no">Enter Roll Number:</label>
        <input type="text" id="roll_no" name="roll_no">
        <input type="submit" value="View Dues">
    </form>

    <?php
    // Check if a student's roll_no is provided
    if (isset($_GET['roll_no'])) {
        // Database connection parameters
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'student_database';

        // Create a database connection
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $roll_no = $_GET['roll_no'];

        // Query to fetch dues for the specified student
        $sql = "SELECT * FROM DUES_INFORMATION WHERE roll_no = $roll_no";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<center><h2>Dues for Student with Roll No: $roll_no</h2>";
            echo "<table>";
            echo "<tr><th>Mess Dues</th><th>Fees Due</th><th>Fines Due</th><th>Total Dues</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["mess_dues"] . "</td>";
                echo "<td>" . $row["fees_due"] . "</td>";
                echo "<td>" . $row["fines_due"] . "</td>";
                echo "<td>" . $row["total_dues"] . "</td>";
                echo "</tr>";
            }

            echo "</table></center>";
        } else {
            echo "No dues found for the specified student.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>
</html>
