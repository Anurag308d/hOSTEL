<!DOCTYPE html>
<html>
<head>
    <title>Student Categories and Gender</title>
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
    <h1>Student Categories and Gender</h1>

    <?php
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

    // Create an array to store course names
    $courses = array(
        'B.Tech CSE', 'B.Tech ECE', 'M.Tech CSE', 'M.Tech ECE',
        'Ph.D. CSE (Full-time)', 'Ph.D. CSE (Part-time)', 'Ph.D. ECE (Full-time)', 'Ph.D. ECE (Part-time)'
    );

    echo "<center><table>";
    echo "<tr><th>Course</th><th>Male</th><th>Female</th><th>General</th><th>OBC</th><th>SC</th><th>ST</th><th>Total</th></tr>";

    // Loop through the courses and retrieve data
    foreach ($courses as $course) {
        // Query to fetch student categories and gender for a specific course
        $sql = "SELECT
            SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS Male,
            SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS Female,
            SUM(CASE WHEN category = 'General' THEN 1 ELSE 0 END) AS General,
            SUM(CASE WHEN category = 'OBC' THEN 1 ELSE 0 END) AS OBC,
            SUM(CASE WHEN category = 'SC' THEN 1 ELSE 0 END) AS SC,
            SUM(CASE WHEN category = 'ST' THEN 1 ELSE 0 END) AS ST
            FROM STUDENT_MAIN_INFORMATION
            WHERE prog = '$course';";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $course . "</td>";
                echo "<td>" . $row["Male"] . "</td>";
                echo "<td>" . $row["Female"] . "</td>";
                echo "<td>" . $row["General"] . "</td>";
                echo "<td>" . $row["OBC"] . "</td>";
                echo "<td>" . $row["SC"] . "</td>";
                echo "<td>" . $row["ST"] . "</td>";
                echo "<td>" . ($row["Male"] + $row["Female"]) . "</td>";
                echo "</tr>";
            }
        }
    }
    echo "</table></center>";

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
