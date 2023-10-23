<?php
	session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Fines</title>
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
	<center><h4>Manage Fines</h4><br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Student Roll</th>
						<th>Fine Type</th>
						<th>Amount Payable</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php
				$connection = mysqli_connect("localhost", "root", "");
				$db = mysqli_select_db($connection, "student_database");
				$query = "select * from other_fine_information";
				$query_run = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_assoc($query_run)) 
                {
				?>
					<tr>
						<td><?php echo $row['roll_no']; ?></td>
						<td><?php echo $row['type_of_fine']; ?></td>
						<td><?php echo $row['amount_payable']; ?></td>
						<td>
							<button class="btn" name=""><a href="edit_fine.php?fine_id=<?php echo $row['fine_id']; ?>">Edit</a></button>
							<button class="btn"><a href="delete_fine.php?fine_id=<?php echo $row['roll_no']; ?>">Delete</a></button>
						</td>
					</tr>
				<?php
				}
				?>
			</table></center>
		</div>
		<div class="col-md-2"></div>
	</div>
</body>
</html>
