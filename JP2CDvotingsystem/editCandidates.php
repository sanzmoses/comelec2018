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
		if(!isset($_GET['id'])){
			header("location: candidates.php");
		}

?>
<?php 
	$editCandidate = "";
if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT * FROM candidates WHERE id_number = '$id'";
		$query = mysqli_query($con,$sql);
		$rowCount = mysqli_num_rows($query);
		if($rowCount > 0){
			while($row = mysqli_fetch_array($query)){
				$idnumber = $row["id_number"];
				$firstname = $row["firstname"];
				$mi = $row["mi"];
				$lastname = $row["lastname"];
				$course = $row["course"];
				$year = $row["year"];
				$partylist = $row["partylist"];
				$position = $row["position"];
				$editCandidate = '<tr>
									<td>ID number</td>
									<td>
										<input type="text" class="code" name="idnumber" value="'.$idnumber.'"" maxlength="7">
									</td>
								</tr> 
								<tr>
									<td>First Name</td>
									<td><input type="text" name="firstname" value="'.$firstname.'"></td>
								</tr>
								<tr>
								 <td>Middle Initial &nbsp</td>
								 <td><input type="text" name="mi" value="'.$mi.'"></td>
								 </tr>
								 <tr>
								  <td>Last Name &nbsp</td>
								  <td><input type="text" name="lastname" value="'.$lastname.'"></td>	
								  </tr>
								  <tr>
								  <td>Course</td>

								  <td><select name="course">
								  	<option value="'.$course.'" selected>'.$course.'</option>
								  	<option value="BA">BA</option>
									<option value="CRIM">CRIM</option>
									<option value="CHM">CHM</option>
									<option value="EDUC">EDUC</option>
									<option value="ENGINEERING">ENGINEERING</option>
									<option value="ICT">ICT</option>
									<option value="NURSING">NURSING</option>
								  </select >
								  <td>
								  </tr>
								  <tr>

								  <td>Year</td>
								  <td>
								  	<select name="year">
								  	<option value="'.$year.'" selected>'.$year.'</option>
								  	<option value="1">1st year</option>
									<option value="2">2nd year</option>
									<option value="3">3rd year</option>
									<option value="4">4th year</option>
								  </select></td>
								  </tr>
								  <tr>

								  <td>Partylist</td>
								  <td>
								  <input type="text" name="partylist" value="'.$partylist.'">
								  </td>
								  </tr>
								  <tr>
								  <td>Position</td>
								  <td><input type="text" name="position" value="'.$position.'"></td>
								  </tr>
								  ';
			}
		}
	}
?>
<?php 
	$queryMessage = "";
if(isset($_POST["submit"])){
	
	$idnumber = $_POST["idnumber"];
	$firstname = $_POST["firstname"];
	$mi = $_POST["mi"];
	$lastname = $_POST["lastname"];
	$course = $_POST["course"];
	$year = $_POST["year"];
	$partylist = $_POST["partylist"];
	$position = $_POST["position"];

	$sql = "UPDATE candidates SET id_number = '$idnumber', firstname = '$firstname', lastname = '$lastname', mi = '$mi', course = '$course', year = '$year', partylist = '$partylist', position = '$position' WHERE id_number = '$idnumber'";
	$query = mysqli_query($con,$sql);
	if($query){
		$queryMessage = "<h3>changes has been saved</h3>";
	}else {
		$queryMessage = "there was a error";
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
		<li><a href="about.php"><i class="fa fa-info fa-1g"></i>About</a></li>
	</ul>

</div>	
<div class="main-content">
	<?php echo $queryMessage; ?>
	<h3>Edit Candidate</h3>
	<form method="POST" class="editCandidates" name="editCandidates" action="editCandidates.php" style="width: 90%;height: 500px">
	<table>
	<?php echo $editCandidate; ?>

	</table>
	<input type="submit" name="submit" value="Save" style="margin-bottom:10px;">
	</form>
</div>
</form>
</body>
</html>
<style>
	td {
		height: 50px;
		padding-right: 30px;
		}
</style>
<script>
function validation(){
	var count = document.forms["createBallot"]["idnum[]"].length;
	var idnumInput = document.forms["createBallot"]["idnum[]"];
	var firstnameInput = document.forms["createBallot"]["firstname[]"];
	var middleinitialInput = document.forms["createBallot"]["middleinitial[]"];
	var lastnameInput = document.forms["createBallot"]["lastname[]"];
	var courseSelect = document.forms["createBallot"]["course[]"];
	var yearSelect = document.forms["createBallot"]["year[]"];
	var partylistSelect = document.forms["createBallot"]["partylist[]"];
	for(var i = 0; i < count;i++){
		var letters = /^[a-zA-Z- ]+$/;
		var inputField1 = idnumInput;

		if(idnumInput[i].value == ""){
			idnumInput[i].focus();
			alert("please input all forms");
			return false;
		}else if (idnumInput[i].value.length < 7){
			idnumInput[i].focus();
			alert("ID number must have exactly 6 digits");
			return false;
		}

		
		if(firstnameInput[i].value == ""){
			firstnameInput[i].focus();
			alert("Please fill up firstname");
			return false;
		}else if (!firstnameInput[i].value.match(letters)){
			firstnameInput[i].focus();
			alert("first name must only contain letters");
			return false;
		}
		
		if(middleinitialInput[i].value == ""){
			middleinitialInput[i].focus();
			alert("Please fill up middle initial");
			return false;
		}else if (!middleinitialInput[i].value.match(letters)){
			middleinitialInput[i].focus();
			alert("middle initial must only contain a letter");
			return false;
		}

		if(lastnameInput[i].value == ""){
			lastnameInput[i].focus();
			alert("Please fill up last name");
			return false;
		}else if (!lastnameInput[i].value.match(letters)){
			lastnameInput[i].focus();
			alert("lastst name must only contain letters");
			return false;
		}

		if(courseSelect[i].value == ""){
			courseSelect[i].focus();
			alert("Please select course");
			return false;
		}

		if(yearSelect[i].value == ""){
			yearSelect[i].focus();
			alert("Please select year level");
			return false;
		}

		if(partylistSelect[i].value == ""){
			partylistSelect[i].focus();
			alert("Please please fill up partylist");
			return false;
		}else if (!partylistSelect[i].value.match(letters)){
			partylistSelect[i].focus();
			alert("Party list must only contain a letter");
			return false;
		}

		//check for duplicate
		var j =0;
		for(j = i +1 ; j < count){
			inputField2 = idnum;
			if(idnum[i].value == idnum[j].value){
				idnum.focus();
				alert("There is a Dulpicate ID number");
			}
		}		
	}
	return true;

}

$(document).ready(function() {
    $(document).delegate(".code","keydown",function(e) {
        if (
            $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
        }

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

        if($(e.target).val().length == 2) {
            e.target.value = e.target.value + "-";
        }
    });
});
document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear();
}
</script>