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

// Variables to store student details
$roll_no = "";
$name = "";
$address = "";
$gender = "";
$category = "";
$dept = "";
$prog = "";
$mobile = "";
$email = "";

if (isset($_POST['get_student_details'])) {
    $roll_no = $_POST['roll_no'];

    // Fetch student details based on the roll_no
    $query = "SELECT * FROM STUDENT_MAIN_INFORMATION WHERE roll_no = '$roll_no'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $student_data = mysqli_fetch_assoc($query_run);

        $name = $student_data['name'];
        $address = $student_data['address'];
        $gender = $student_data['gender'];
        $category = $student_data['category'];
        $dept = $student_data['dept'];
        $prog = $student_data['prog'];
        $mobile = $student_data['mobile'];
        $email = $student_data['email_id'];
    } else {
        echo "<script>alert('Student record not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
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

<center><h4>Edit Student Details</h4></center>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="roll_no">Student Roll Number:</label>
                <input type="text" name="roll_no" class="form-control" required>
                <button type="submit" name="get_student_details" class="btn btn-primary">Get Student Details</button>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" value="<?php echo $category; ?>">
            </div>
            <div class="form-group">
                <label for="dept">Department:</label>
                <input type="text" name="dept" class="form-control" value="<?php echo $dept; ?>">
            </div>
            <div class="form-group">
                <label for="prog">Program:</label>
                <input type="text" name="prog" class="form-control" value="<?php echo $prog; ?>">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <button type="submit" name="edit_student" class="btn btn-primary">Edit Student</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

</body>
</html>

<?php
if (isset($_POST['edit_student'])) {
    // Retrieve the edited student details from the form
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $dept = $_POST['dept'];
    $prog = $_POST['prog'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    // Update student details in the database
    $update_query = "UPDATE STUDENT_MAIN_INFORMATION 
                    SET name = '$name', address = '$address', gender = '$gender', category = '$category',
                    dept = '$dept', prog = '$prog', mobile = '$mobile', email_id = '$email'
                    WHERE roll_no = '$roll_no'";
    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) {
        echo "<script>alert('Student details updated successfully.');</script>";
    } else {
        echo "Error updating student details: " . mysqli_error($connection);
    }
}
?>
