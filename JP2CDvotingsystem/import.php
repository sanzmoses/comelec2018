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
	if($row > 0 ){
		header("location: admin.php");
		exit();
	}
?>
<?php 
		$message = "";
		if(isset($_POST["submit"])){
			
			if(isset($_FILES['file'])){
				$name_array = $_FILES['file']['name'];
				$tmp_name_array = $_FILES['file']['tmp_name'];
				$type = $_FILES['file']['type'];
				$error = $_FILES['file']['error'];
				for($i = 0; $i < count($tmp_name_array);$i++){
					$check = pathinfo($name_array[$i], PATHINFO_EXTENSION);
		
					if($check != "csv"){
						$message = "CSV file only!";
					}else {
						
						$handle = fopen($tmp_name_array[$i],"r");
						do {
							if(isset($data[0])){
					 		$import = mysqli_query($con,"INSERT INTO students (last_name, first_name, ID_number, course, year) VALUES('".addslashes($data[0])."','".addslashes($data[1])."','".addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."')"); 
							}else {
								$message = "<h4><span style=\"color:#ee483b;\">Import Successful</span></h4><br>";	
										
							}
							}while ($data = fgetcsv($handle,1000,",","'"));
					}
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
	<h3><i class="fa fa-exclamation-circle fa-1g"></i>INSTRUCTIONS (IMPORTANT)<h3>	
		<ol class="instuctions">
			<li>Before to import <b>The List of Students</b>, the file must be in a <b>CSV file format</b>.</li>
			<li>To convert to CSV, open the MS Excel worksheet(.xlsx) provided by the registrar, the worksheet will consist all courses of ST.JPIICD tables(educ,chm, etc.)</li>
			<li>Click on the table Tab(example. ICT tab table) at the lower left corner.</li>
			<li>after that Select the column A, Once clicked it will select the whole column, right-click and then <b>'DELETE'</b> (make sure the numbers are deleted and the last names will move to the Column A)</li>
			<li>Once deleted, <b>'Save As'</b> the table to exactly <b>CSV(Comma delimited) file format</b> make sure to rename the file according to the table selected (example. ICT.csv)</li>
		</ol>
	 	<form method="post" action="import.php" name="import" enctype="multipart/form-data" onsubmit=
	 	"return validation();">
	 		<h4><span style="color:#ee483b;"><?php echo $message; ?></span><h4><br>
	 		<table>
	 		<tr>
	 		<td>
	 		<label>BA</label>
	 		</td>
	 		<td>
	 		<input type="file" name="file[]" id="file">
	 		</td>
	 		</tr>
	 		<tr>
	 		<td>
	 		<label>CHM</label>
	 		</td>
	 		<td>
			<input type="file" name="file[]" id="file">
			</td>
			</tr>
			<tr>
	 		<td>
			<label>CRIM</label>
			</td>
			<td>
			<input type="file" name="file[]" id="file">
			</td>
			</tr>
			<tr>
	 		<td>
			<label>EDUC</label></td>
			<td><input type="file" name="file[]" id="file"></td>
			</tr>
			<tr>
	 		<td>
			<label>ENG'G</label></td>
			<td><input type="file" name="file[]" id="file"></td>
			</tr>
			<tr>
	 		<td>
			<label>ICT</label></td>
			<td><input type="file" name="file[]" id="file"></td>
			</tr>
			<tr>
	 		<td>
			<label>NURSING</label></td>
			<td><input type="file" name="file[]" id="file"></td>
			</tr>
			</table>
			<input type="submit" name="submit" value="Import All"> <p>It will take a few seconds to Import</p>
	 	</form>
	
</div>
</form>
</body>
<style>
form {
	margin-top: 40px;
}
td {
	padding-right: 40px;
}
ol li {
	margin-top: 15px;
}
ol li{
	margin-bottom: 10px;
}

button{
	padding: 10px 15px 10px 15px;
	border:none;
	background:#3598dc;
	color:#fff;
}
button:hover {
	background:#1d8ad3;
}
</style>
</html>

<script>
function validation(){
	var count = document.forms["import"]["file[]"].length;
	var files = document.forms["import"]["file[]"];
	for(var i =0; i < count;i++){
		if(files[i].value == ""){
			alert("Please choose CSV file for every Course");
			files[i].focus();
			return false;
		}
	}
	return true;
}

document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear();
}
</script>