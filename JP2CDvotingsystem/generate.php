<?php
session_start();
require 'connect_database.php';
include 'getResults.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}	
	
?>
<?php 
	$message = "";
	$sql = "SELECT * FROM students";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	if($row == 0 ){
		$message = '<p>Student Table is empty. <a href="students.php">Click here to import List of Students</a></p>';
	}
?>
<?php 
	$sql = "SELECT * FROM students WHERE passcode = '' ";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	if($row > 0){
		$message = '<button type="submit" name="submit">Click here to Generate passwords</button>';
	}else {
		$message = "Student table has already have passwords";
	}
?>
<?php 
$message2 = "";
if(isset($_POST["submit"])){
	function generate(){
		 	$characters='123456789';
			$pass_characters = str_split($characters);
			$pass_length = "6";
			$password='';
		 
		  	for($i=0;$i<$pass_length;$i++){
				$password.=$pass_characters[rand(0,count($pass_characters)-1)];
			}

			return $password;  	
		
	}
	
	$sql = "SELECT * FROM students";
	$query = mysqli_query($con,$sql);
	$numRows = mysqli_num_rows($query);
	$numRows = $numRows + 1;
	
	for($i = 1; $i < $numRows;$i++){
		$gen = generate();
		

		$sql2 = "UPDATE students SET passcode = '$gen' WHERE id='$i' ";
		$query2 = mysqli_query($con,$sql2);
		if($query2){
			$message2 = "Passwords has been generated!";
		}else {
			$message2 = "Something went wrong";
		}
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
<script src="js/jquery-1.11.2.js"></script>	
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
		
		<form method="POST" action="generate.php" name="generate">
			<?php echo $message2; ?>
			<?php echo $message; ?>
			<p>it will take a few seconds to generate.</p>
		</form>
	 	
	
</div>
</form>
</body>
<style>

button{
	font-family: 'Lato-Black';
	padding: 10px 15px 10px 15px;
	border:none;
	background:#3598dc;
	color:#fff;
	margin-bottom: 20px;
}
button:hover {
	background:#1d8ad3;
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