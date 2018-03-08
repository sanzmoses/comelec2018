<?php 
	require 'connect_database.php';
	$sql = "TRUNCATE TABLE votes";
	$query = mysqli_query($sql);
	if($query){
		header("location: admin.php");
	}
?>
<?php 

	$sql = "SELECT * FROM votes";
	$query = mysqli_query($con,$sql);
	$row = mysqli_num_rows($query);
	if($row == 0){
		header("location: admin.php");
	}
?>