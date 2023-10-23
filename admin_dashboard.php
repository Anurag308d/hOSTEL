<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body class=" bg-dark">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">HOSTEL DATABASE</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
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
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
		<div class="container-fluid">
			
		    <ul class="nav navbar-nav navbar-center">
		      <li class="nav-item">
		        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Fine </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_fine.php">Add Fine</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_fine.php">Manage Fine</a>
	        	</div>
		      </li>
              <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Student</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_student.php">Add Student</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_student.php">Delete Student</a>
					<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_student.php">Edit Student</a>
	        	</div>
		      </li>
			  <li class="nav-item">
		        <a class="nav-link" href="add_dues.php">Add Dues</a>
		      </li>
			  <li class="nav-item">
		        <a class="nav-link" href="add_room.php">Change Room</a>
		      </li>
	          <li class="nav-item">
		        <a class="nav-link" href="make_payment.php">Make Payment</a>
		      </li>
		    </ul>
		</div>
	</nav><br><br><br>
	<div class="row">
		<div class="col-md-4" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Rooms</div>
				<div class="card-body">
					<p class="card-text">No of Rooms Available: </p>
					<a class="btn btn-danger" href="regroom.php" target="_blank">View</a>
				</div>
			</div>
		</div>
		<div class="col-md-4" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Dues</div>
				<div class="card-body">
					<p class="card-text">Check Dues of a Paticular Student: </p>
					<a class="btn btn-success" href="Regdues.php" target="_blank">View</a>
				</div>
			</div>
		</div>
		<div class="col-md-4" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Categories</div>
				<div class="card-body">
					<p class="card-text">Categories Table of All the Students</p>
					<a class="btn btn-warning" href="Regcatego.php" target="_blank">View Table</a>
				</div>
			</div>
		</div>
</body>
</html>