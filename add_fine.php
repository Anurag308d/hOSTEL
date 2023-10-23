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
    <title>Add Fine</title>
    <script type="text/javascript">
        function alertMsg() {
            alert("Fine added successfully...");
            window.location.href = "admin_dashboard.php";
        }
    </script>
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
    
    <center><h4>Add a Fine</h4><br></center>
    <div class="row">
        
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form action="" method="post">
            <div class="form-group">
                        <label for="book_name">Student Roll Number:</label>
                        <input type="text" name="roll_no" class="form-control" required>
            </div>
            <div class="form-group">
                        <label for="book_author">Type of Fine:</label>
                        <input type="text" name="fine_type" class="form-control" required>
            </div>
            <div class="form-group">
                        <label for="book_category">Amount Payable:</label>
                        <input type="text" name="amount_payable" class="form-control" required>
            </div>
            <button type="submit" name="add_fine" class="btn btn-primary">Add Fine</button>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    

</body>
</html>

<?php
    if(isset($_POST['add_fine'])) {
        $roll_no = $_POST['roll_no'];
        $fine_type = $_POST['fine_type'];
        $amount_payable = $_POST['amount_payable'];

        $query = "INSERT INTO other_fine_information (roll_no, type_of_fine, amount_payable) VALUES ('$roll_no', '$fine_type', '$amount_payable')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            echo "<script>alertMsg();</script>";
        } else {
            echo "Error adding fine: " . mysqli_error($connection);
        }
    }
?>
