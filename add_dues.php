<?php
session_start();

// Database connection parameters
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'student_database';

// Create a database connection
$connection = mysqli_connect($db_host, $db_username, $db_password);
$db = mysqli_select_db($connection, $db_name);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Dues</title>
    <script type="text/javascript">
        function alertMsg() {
            alert("Dues added successfully...");
            window.location.href = "admin_dashboard.php";
        }
    </script>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
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
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile</a>
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

<center><h4>Add Dues</h4><br></center>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="roll_nos">Student Roll Numbers (comma-separated):</label>
                <input type="text" name="roll_nos" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dues_type">Type of Dues:</label>
                <select name="dues_type" class="form-control" required>
                    <option value="mess_dues">Mess Dues</option>
                    <option value="fees_due">Fees Dues</option>
                    <option value="fines_due">Fines Dues</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount_payable">Amount Payable:</label>
                <input type="text" name="amount_payable" class="form-control" required>
            </div>
            <button type="submit" name="add_dues" class="btn btn-primary">Add Dues</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>

<?php
if (isset($_POST['add_dues'])) {
    $roll_nos = $_POST['roll_nos'];
    $dues_type = $_POST['dues_type'];
    $amount_payable = $_POST['amount_payable'];

    $roll_no_array = explode(',', $roll_nos);
    foreach ($roll_no_array as $roll_no) {
        $roll_no = trim($roll_no);

        // Check if dues exist for the specified student
        $query = "SELECT * FROM DUES_INFORMATION WHERE roll_no = '$roll_no'";
        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) > 0) {
            // Dues exist, update the specific type of dues
            $row = mysqli_fetch_assoc($query_run);
            $existing_amount = $row[$dues_type];
            $new_amount = $existing_amount + $amount_payable;

            // Update the specific type of dues
            $update_query = "UPDATE DUES_INFORMATION SET $dues_type = '$new_amount' WHERE roll_no = '$roll_no'";
            mysqli_query($connection, $update_query);

            // Calculate the new total dues
            $query = "SELECT mess_dues, fees_due, fines_due FROM DUES_INFORMATION WHERE roll_no = '$roll_no'";
            $query_run = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($query_run);
            $total_dues = $row['mess_dues'] + $row['fees_due'] + $row['fines_due'];

            // Update the total dues
            $update_total_query = "UPDATE DUES_INFORMATION SET total_dues = '$total_dues' WHERE roll_no = '$roll_no'";
            mysqli_query($connection, $update_total_query);
        } else {
            // Dues do not exist, insert new dues with the specific type and total dues
            $insert_query = "INSERT INTO DUES_INFORMATION (roll_no, $dues_type, total_dues) VALUES ('$roll_no', '$amount_payable', '$amount_payable')";
            mysqli_query($connection, $insert_query);
        }
    }

    echo "<script>alertMsg();</script>";
}
?>
