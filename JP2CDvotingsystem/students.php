<?php 
	session_start();
require 'connect_database.php';
include 'getResults.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}	

	$displayStudent ="";
	if(isset($_POST["submit"])){
		$search = $_POST["search"];
		$sql = "SELECT * FROM students WHERE ID_number LIKE '%$search%' OR last_name LIKE '%$search%'";
		$query = mysqli_query($con,$sql);
		$rowCount = mysqli_num_rows($query);
		if($rowCount > 0 ){
			while($student = mysqli_fetch_array($query)){
				$idnum = $student["ID_number"];
				$passcode = $student["passcode"];
				$name = mb_convert_encoding($student["last_name"],'UTF-8','ISO-8859-1').', '. $student["first_name"];
				$course = $student["course"];
				$vote = $student["vote"];
				$displayStudent .= '<tr>
										<td>'.$idnum.'</td>
										<td>'.$passcode.'</td>
										<td>'.$name.'</td>
										<td>'.$course.'</td>
										<td>'.$vote.'</tD>
									</tr>
									';
			}
		}else {
			$displayStudent = '<p>No match found<p>';
		}
	}

?>
<?php 
	$gen1 = "";
	$sql='SELECT * FROM students WHERE passcode = ""';
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	if($row > 0){
		$gen1 = '<h3>No passwords has been generated yet.</h3>
				<a href="generate.php"><button class="gen" name="submit">Click Here to Generate passwords</button></a><br>';
	}

?>
<?php 
	$gen = "";
	$sql = "SELECT * FROM students";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	if($row < 0){
		$gen = '<h3>Student table is empty</h3>
				<a href="import.php"><button type="submit" class="gen" name="submit">Click Here to Import Student List</button></a>';
	}else {
		$gen = '<br>
	<form name="searchfrm" method="POST" action="students.php">
	<input type="text" name="search" style="background:#a2cde8;" class="searchInput" placeholder="Search" autocomplete="disable"><br>
	<p style="color:#bcc0c9;">(Search using ID number or Last name)</p>
	<button type="submit" name="submit"><i class="fa fa-search fa-1g"></i><span>Search</span></button>
	</form>
	<table>
		<tr class="header">
		<th>ID number</th>
		<th>Password</th>
		<th>Name</th>
		<th>Course</th>
		<th>Status</th>
		</tr>'. $displayStudent	 .'
	
	</table>';
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Admin page | SSC Election <?php 
	echo date("Y");
?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
	<h3>Students</h3>
	
	<?php echo $gen;?>
	<?php echo $gen1; ?>
	
</div>
</body>
<style>
	button {
		font-family:'Lato-Black';
		border:none;
		width: 200px;
		height: 40px;
		background:#3598dc;
		margin-bottom: 20px;
		margin-top: 20px;
		display:block;
	}
	.gen {
		font-family:'Lato-black';
		border:none;
		width: 340px;
		height: 50px;
		background:#3598dc;
		margin:15px 0 15px 0;
		color:#fff;
	}
	table{
		width: 75%;
		background:#ecf0f1;
		margin-bottom: 20px;
	}
	span {
		display:inline;
	}
	td {
		font-family:'Lato-regular';
		height: 35px;
		padding-left: 15px;
		padding-right: 15px;
	}
	th:nth-child(5){
		padding-right: 20px;
	}
	tr:nth-child(even) {
		background:#fffffe;
	}
	::-webkit-input-placeholder {
   color: #000;
	}
	td:nth-child(2){
		letter-spacing: 0.6px;
		background:#73bc75;
	}
	.header {
		background:#3598dc;
		height: 40px;
	}

	.courses ul{
		list-style-type:none;
	}
	.courses li {
		display:block;
	}
	.courses a {
		padding: 7px 15px 7px 15px;
	}
</style>
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