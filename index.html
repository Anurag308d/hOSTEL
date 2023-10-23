<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>studentDatabase</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	#main_content{
		padding: 50px;
		background-color: whitesmoke;
	}
	#side_bar{
		background-color: whitesmoke;
		padding: 50px;
		width: 300px;
		height: 450px;
	}
</style>
<body class="navbar-dark bg-dark">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">HOSTEL DATABASE</a>
			</div>
		</div>
	</nav><br><br><br>
	<div class="row">
		<div class="col-md-3 navbar-dark bg-dark" id="side_bar">
            
		</div>
		<div class="col-md-6" id="main_content">
			<center><h3><u>Warden's Login Page</u></h3></center>
			<form action="" method="post">
				<div class="form-group">
					<label for="email">Email ID:</label>
					<input type="text" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" name="login" class="btn btn-primary">Login</button> |
				<a href="signup.php"> Not registered yet ?</a>	
			</form>
			<?php 
				if(isset($_POST['login']))
                {
					$connection = mysqli_connect("localhost","root","");
					$db = mysqli_select_db($connection,"student_database");
					$query = "select * from admins where email = '$_POST[email]'";
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)) 
                    {
						if($row['email'] == $_POST['email'])
                        {
							if($row['password'] == $_POST['password'])
                            {
								$_SESSION['name'] =  $row['name'];
								$_SESSION['email'] =  $row['email'];
								$_SESSION['id'] =  $row['id'];
								header("Location:admin_dashboard.php");
							}
							else
                            {
								?>
								<br><br><center><span class="alert-danger">Wrong Password !!</span></center>
								<?php
							}
						}
					}
				}
			?>
		</div>
		<div class="col-md-3 navbar-dark bg-dark" id="side_bar">
            
        </div>
	</div>
</body>
</html>

