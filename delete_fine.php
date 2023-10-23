<?php
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "student_database");
	if (isset($_GET['fine_id'])) 
    {
		$fine_id = $_GET['fine_id'];
		$query = "DELETE FROM other_fine_information WHERE fine_id = $fine_id";
		$query_run = mysqli_query($connection, $query);

		if ($query_run) 
        {
			echo '<script>alert("Fine deleted successfully...");</script>';
		} 
        else 
        {
			echo '<script>alert("Error deleting fine...");</script>';
		}
	} 
    else 
    {
		echo '<script>alert("Invalid parameters...");</script>';
	}
	echo '<script>window.location.href = "manage_fine.php";</script>';
?>
