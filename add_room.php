<!DOCTYPE html>
<html>
<head>
    <title>Room Change</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">HOSTEL DATABASE</a>
			</div>
            <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="view_profile.php">View Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Change Password</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br><br>
    

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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $roll_no = $_POST['roll_no'];
        $new_room = $_POST['new_room'];

        // Get the current room of the student
        $current_room_sql = "SELECT room_no FROM HOSTEL_INFORMATION WHERE roll_no = $roll_no";
        $current_room_result = $conn->query($current_room_sql);
        $current_room_row = $current_room_result->fetch_assoc();
        $current_room = $current_room_row['room_no'];

        // Update the room for the student
        $update_sql = "UPDATE HOSTEL_INFORMATION SET room_no = '$new_room' WHERE roll_no = $roll_no";

        if ($conn->query($update_sql) === TRUE) {
            // Set the previous room as available (free)
            $update_previous_room_sql = "UPDATE HOSTEL_INFORMATION SET roll_no = NULL WHERE room_no = '$current_room'";
            if ($conn->query($update_previous_room_sql) === TRUE) {
                echo "Room change for Roll No: $roll_no was successful. Student moved to Room: $new_room.";
                echo "<br>Room $current_room is now available (free).";
            } else {
                echo "Error updating the previous room: " . $conn->error;
            }
        } else {
            echo "Error updating room: " . $conn->error;
        }
    }

    // Fetch the list of available rooms for the dropdown
    $rooms_sql = "SELECT DISTINCT room_no FROM HOSTEL_INFORMATION WHERE roll_no IS NULL";
    $result = $conn->query($rooms_sql);

    $room_options = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $room_options .= '<option value="' . $row["room_no"] . '">' . $row["room_no"] . '</option>';
        }
    }

    // Close the database connection
    $conn->close();
    ?>

<center>
    <h3>Make a Room Change for a Student</h3><br><br>
    <table>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <tr>
                <td>
                    <label for="roll_no">Enter Roll Number:</label>
                </td>
                <td>
                    <input type="text" id="roll_no" name="roll_no">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="new_room">Select New Room:</label>
                </td>
                <td>
                    <select name="new_room">
                        <?php echo $room_options; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center><input type="submit" value="Make Room Change"></center>
                </td>
            </tr>
        </form>
    </table></center>

</body>
</html>
