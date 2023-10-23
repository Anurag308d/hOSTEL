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
    <title>Add Student</title>
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
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="view_profile.php">View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class "dropdown-item" href="edit_profile.php">Edit Profile</a>
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

<center><h4>Add a Student</h4></center>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="roll_no">Roll Number:</label>
                <input type="text" name="roll_no" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dept">Department:</label>
                <input type="text" name="dept" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prog">Program:</label>
                <select name="prog" class="form-control" required>
                    <option value="B.Tech CSE">B.Tech CSE</option>
                    <option value="B.Tech ECE">B.Tech ECE</option>
                    <option value="M.Tech CSE">M.Tech CSE</option>
                    <option value="M.Tech ECE">M.Tech ECE</option>
                    <option value="Ph.D. CSE (Full-time)">Ph.D. CSE (Full-time)</option>
                    <option value="Ph.D. CSE (Part-time)">Ph.D. CSE (Part-time)</option>
                    <option value="Ph.D. ECE (Full-time)">Ph.D. ECE (Full-time)</option>
                    <option value="Ph.D. ECE (Part-time)">Ph.D. ECE (Part-time)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" class="form-control">
            </div>
            <div class="form-group">
                <label for="email_id">Email ID:</label>
                <input type="text" name="email_id" class="form-control">
            </div>
            <button type="submit" name="add_student" class="btn btn-primary">Add Student</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

</body>
</html>

<?php
if (isset($_POST['add_student'])) {
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $dept = $_POST['dept'];
    $prog = $_POST['prog'];
    $mobile = $_POST['mobile'];
    $email_id = $_POST['email_id'];

    $query = "INSERT INTO STUDENT_MAIN_INFORMATION (roll_no, name, address, gender, category, dept, prog, mobile, email_id) 
              VALUES ('$roll_no', '$name', '$address', '$gender', '$category', '$dept', '$prog', '$mobile', '$email_id')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "<script>alert('Student added successfully...');</script>";
    } else {
        echo "Error adding student: " . mysqli_error($connection);
    }
}
?>
