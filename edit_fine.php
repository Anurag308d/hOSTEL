<?php
	session_start();
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "student_database");
	$fine_id = "";
	$type_of_fine = "";
	$amount_payable = "";
	$query = "SELECT * FROM other_fine_information WHERE fine_id = $_GET[fine_id]";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$fine_id = $row['fine_id'];
		$type_of_fine = $row['type_of_fine'];
		$amount_payable = $row['amount_payable'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Fine</title>
</head>
<body>
	<center><h4>Edit Fine</h4><br>
	<div class="row">
		<div class="col-md-4">
			<form action="" method="post">
				<div class="form-group">
					<label for="fine_id">Fine ID:</label>
					<input type="text" name="fine_id" value="<?php echo $fine_id; ?>" class="form-control" disabled required>
				</div>
				<div class="form-group">
					<label for="type_of_fine">Type of Fine:</label>
					<input type="text" name="type_of_fine" value="<?php echo $type_of_fine; ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="amount_payable">Amount Payable:</label>
					<input type="text" name="amount_payable" value="<?php echo $amount_payable; ?>" class="form-control" required>
				</div>
				<button type="submit" name="update" class="btn btn-primary">Update Fine</button>
			</form>
		</div>
	</div></center>
</body>
</html>

<?php
	if(isset($_POST['update']))
    {
		$query = "UPDATE other_fine_information SET type_of_fine = '$_POST[type_of_fine]', amount_payable = '$_POST[amount_payable]' WHERE fine_id = $fine_id";
		$query_run = mysqli_query($connection, $query);
		header("location:manage_fine.php");
	}
?>
