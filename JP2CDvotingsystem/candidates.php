<?php
session_start();
require 'connect_database.php';
include 'getResults.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}	

	$ballotExist = "";
	$sql = "SELECT * FROM candidates";
	$query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($query);
	if($count == 0){
		header("Location: admin.php");
	}

?>

<?php 
	$candidates = "";
	$sql = "SELECT * FROM candidates ORDER BY id_number ASC";
	$query = mysqli_query($con,$sql);
	$rowCount = mysqli_num_rows($query); 
	if($rowCount > 7){
		while($row = mysqli_fetch_array($query)){
			$idnum = $row["id_number"];
			$name = strtoupper($row["lastname"]).', '. ucwords($row["firstname"].' '.$row["mi"].',');
			$course = ucfirst($row["course"]);
			$year = ucfirst($row["year"]);
			$partylist = ucfirst($row["partylist"]);
			$position = ucfirst($row["position"]);
			$candidates .= '
						<tr>
						<td><a href="editCandidates.php?id='.$idnum.'"><i class="fa fa-pencil fa-1g"></i>edit</a></td>
						<td>'.$idnum.'</td>
						<td>'.$name.'</td>
						<td>'.$course.'</td>
						<td>'.$year.'</td>
						<td>'.$partylist.'</td>
						<td>'.$position.'</td>
						</tr>
						';

		}
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Admin page | SSC Election <?php 
	echo date("Y");
?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" media="screen" />
<link rel="Stylesheet" href="Font-awesome/font-awesome-4.3.0/css/font-awesome.css" />	
<link rel="stylesheet" href="normalize.css" />
</head>
<title></title>
<body>
<div class="nav">
	<ul>
		<li><a href="logout.php"><i class="fa fa-power-off"></i>Log Out</a></li>
		<li><a href="" id="para1" ></a></li>

	</ul>
</div>
<div class="left-bar">
<img src="images/	222.png" width="190" height="190" style="margin: 15px 0 0 10px;">
	<ul>
		<li><a href="admin.php"><i class="fa fa-home fa-1g"></i>Home</a></li>
		<li><a href="candidates.php"><i class="fa fa-users fa-1g"></i>Candidates</a></li>
		<li><a href="results.php"><i class="fa fa-bar-chart fa-1g"></i>Votes</a></li>
		<li><a href="students.php"><i class="fa fa-user fa-1g"></i>Students</a></li>
		<li><a href="about.php"><i class="fa fa-info fa-1g"></i>About</a></li>
	</ul>

</div>	
<div class="main-content">
	<h3>Candidates</h3>
	<table class="candidatesTable">	
		<tr class="header">
			<td></td>
			<td>ID number</td>
			<td>Name</td>
			<td>Course</td>
			<td>Year</td>
			<td>Partylist</td>
			<td>Position</td>
		</tr>
		<?php echo $candidates; ?>
	<table>
</div>
</form>
</body>
</html>

<script>
document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear();
}
</script>