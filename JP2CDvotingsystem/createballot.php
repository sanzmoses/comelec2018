 <?php
session_start();
require 'connect_database.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}

	$sql = "SELECT * FROM candidates";
	$query = mysqli_query($con,$sql);
	$rowCount = mysqli_num_rows($query);
	if($rowCount > 8){
		header("location:ballotCreated.php");
	}

	
function clean($data){
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	$data = trim($data);
	$data = htmlspecialchars($data);
	if(get_magic_quotes_gpc()){
		$data = stripslashes($data);
	}
	return mysqli_real_escape_string($con,$data);
}
	$ballotCreated = "";
	$messageDuplicate = "";
	$filecheck = "";
if(isset($_POST["submit"])){
			$countInputs = count($_POST["idnum"]);
			for($i=0;$i < $countInputs;$i++){
				$idnum = clean($_POST["idnum"][$i]);
				$firstname = clean($_POST["firstname"][$i]);
				$lastname = clean($_POST["lastname"][$i]);
				$middleinitial = clean($_POST["middleinitial"][$i]);
				$course = clean($_POST["course"][$i]);
				$year = clean($_POST["year"][$i]);
				$partylist = clean($_POST["partylist"][$i]);
				$position = clean($_POST["position"][$i]);
				
				$newName = $idnum;
					$name_array = $_FILES['photo']['name'];
					$tmp_name_array = $_FILES['photo']['tmp_name'];
					$error_array = $_FILES['photo']['error'];
					$check = pathinfo($name_array[$i],PATHINFO_EXTENSION);
					if($check != "jpg"){
						$message = "Image must be in a JPEG format only!";
					}else {
						move_uploaded_file($tmp_name_array[$i], "images/$newName.jpg");

					}
				$sqlCheck = "SELECT * FROM candidates WHERE id_number ='$idnum'";
				$queryCheck = mysqli_query($con,$sqlCheck);
				$rowCountCheck = mysqli_num_rows($queryCheck);
				if($rowCountCheck > 0){
					$messgaeDuplicate = '<p>There is a duplicate ID</p>';
				}else {
					
				
				$sql = mysqli_query($con,"INSERT INTO candidates(id_number,firstname,lastname,mi,course,year,partylist,position) VALUES ('$idnum','$firstname','$lastname','$middleinitial','$course','$year','$partylist','$position')");
					}
					
				
			}
			
			if($sql){
					$ballotCreated = "Ballot has been created";
					$query = mysqli_query($con,"UPDATE admin SET BallotCreated = 'yes' WHERE id= 1");
				}else {
					echo "ERROR";
				}
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Admin page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" media="screen" />
<link re;="stylesheet" href="normalize.css" />
<link rel="Stylesheet" href="Font-awesome/font-awesome-4.3.0/css/font-awesome.css" />	
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
		<li><a href="about.php"><i class="fa fa-info fa-1g"></i>About</a></li>
	</ul>
</div>	
<div class="main-content">
	<form method="POST" action="createballot.php" name="createBallot" enctype="multipart/form-data" class="createBallot" onsubmit="return validation();">
		<p><?php echo $ballotCreated; ?></p>
		<h2>Create Ballot</h2>
		<p><?php echo $filecheck; ?></p>
		<!--PRESIDENT-->
		<fieldset class="president">
			<h3>President</h3>
			<h4>Candidate 1</h4>
			<input type="text" name="idnum[]" class="code" placeholder="ID number" maxlength="7" autocomplete="off">
			<input type="text" name="firstname[]" placeholder="First Name" autocomplete="off">
			<input type="text" name="middleinitial[]" placeholder="Middle Initial" maxlength="1" autocomplete="off">
			<input type="text" name="lastname[]" placeholder="Last Name" autocomplete="off">
			<select name="course[]">
				<option selected="selected" disabled value="">Course</option>
				<option value="BA">BA</option>
				<option value="CRIM">CRIM</option>
				<option value="CHM">CHM</option>
				<option value="EDUC">EDUC</option>
				<option value="ENGINEERING">ENGINEERING</option>
				<option value="ICT">ICT</option>
				<option value="NURSING">NURSING</option>
			</select>
			<select name="year[]">
				<option selected="selected" disabled value="">Year</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
			<input type="text" name="partylist[]" placeholder="Partylist" autocomplete="off">
			<input type="text" name="position[]" value="President" >
			<input type="file" name="photo[]" /><br>
		</fieldset>
		<!--VICEPRESIDENT INTERNAL-->
		<fieldset class="Vice-presidenti">
			<h3>Vice-President Internal Affairs</h3>
			<h4>Candidate 1</h4>
			<input type="text" name="idnum[]" class="code" placeholder="ID number" maxlength="7" autocomplete="off">
			<input type="text" name="firstname[]" placeholder="First Name" autocomplete="off">
			<input type="text" name="middleinitial[]" placeholder="Middle Initial" maxlength="1"autocomplete="off">
			<input type="text" name="lastname[]" placeholder="Last Name" autocomplete="off">	
			<select name="course[]">
				<option selected="selected" disabled value="">Course</option>
				<option value="BA">BA</option>
				<option value="CRIM">CRIM</option>
				<option value="CHM">CHM</option>
				<option value="EDUC">EDUC</option>
				<option value="ENGINEERING">ENGINEERING</option>
				<option value="ICT">ICT</option>
				<option value="NURSING">NURSING</option>
			</select>
			<select name="year[]">
				<option selected="selected" disabled value="">Year</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
			<input type="text" name="partylist[]" placeholder="Partylist" autocomplete="off">
			<input type="text" name="position[]" value="Vice-president(internal)" >
			<input type="file" name="photo[]" /><br>
		</fieldset>
		<!--VICEPRESIDENT EXTERNAL-->
		<fieldset class="Vice-presidente">
			<h3>Vice-President External Affairs</h3>
			<h4>Candidate 1</h4>
			<input type="text" name="idnum[]" class="code" placeholder="ID number" maxlength="7" autocomplete="off">
			<input type="text" name="firstname[]" placeholder="First Name" autocomplete="off">
			<input type="text" name="middleinitial[]" placeholder="Middle Initial" maxlength="1" autocomplete="off">
			<input type="text" name="lastname[]" placeholder="Last Name" autocomplete="off">		
			<select name="course[]">
				<option selected="selected" disabled value="">Course</option>
				<option value="BA">BA</option>
				<option value="CRIM">CRIM</option>
				<option value="CHM">CHM</option>
				<option value="EDUC">EDUC</option>
				<option value="ENGINEERING">ENGINEERING</option>
				<option value="ICT">ICT</option>
				<option value="NURSING">NURSING</option>
			</select>
			<select name="year[]">
				<option selected="selected" disabled value="">Year</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
			<input type="text" name="partylist[]" placeholder="Partylist" autocomplete="off">
			<input type="text" name="position[]" value="Vice-president(external)" >
			<input type="file" name="photo[]" /><br>
		</fieldset>
		<!--VICEPRESIDENT FINANCE-->
		<fieldset class="Vice-presidente">
			<h3>Vice-President Finance Affairs</h3>
			<h4>Candidate 1</h4>
			<input type="text" name="idnum[]" class="code" placeholder="ID number" maxlength="7" autocomplete="off">
			<input type="text" name="firstname[]" placeholder="First Name" autocomplete="off">
			<input type="text" name="middleinitial[]" placeholder="Middle Initial" maxlength="1" autocomplete="off">
			<input type="text" name="lastname[]" placeholder="Last Name" autocomplete="off">		
			<select name="course[]">
				<option selected="selected" disabled value="">Course</option>
				<option value="BA">BA</option>
				<option value="CRIM">CRIM</option>
				<option value="CHM">CHM</option>
				<option value="EDUC">EDUC</option>
				<option value="ENGINEERING">ENGINEERING</option>
				<option value="ICT">ICT</option>
				<option value="NURSING">NURSING</option>
			</select>
			<select name="year[]">
				<option selected="selected" disabled value="">Year</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
			<input type="text" name="partylist[]" placeholder="Partylist" autocomplete="off">
			<input type="text" name="position[]" value="Vice-president(finance)" >
			<input type="file" name="photo[]" /><br>
		</fieldset>
		<fieldset class="Councilors">
			<h3>Councilors</h3>
			<p>(only 6 candidates can be elected.)</p>
			<h4>Candidates</h4>
			<?php
				for($i=1; $i < 11; $i++){
					echo "<h4>".$i.'.'."</h4>";
					include 'inputs.php';
					echo "<br>";
				}
			?>
		</fieldset>
		<button class="add" type="button"><i class="fa fa-plus fa-1g"></i>Add more candidates</button><br>
		<button type="submit" name="submit" class="create"><i class="fa fa-file-o fa-1g"></i><span>Create Ballot</span></button>
	</form>
</div>
</form>
</body>
</html>
<script>
function validation (){
	var count = document.forms["createBallot"]["idnum[]"].length;
	var idnumInput = document.forms["createBallot"]["idnum[]"];
	var firstnameInput = document.forms["createBallot"]["firstname[]"];
	var middleinitialInput = document.forms["createBallot"]["middleinitial[]"];
	var lastnameInput = document.forms["createBallot"]["lastname[]"];
	var courseSelect = document.forms["createBallot"]["course[]"];
	var yearSelect = document.forms["createBallot"]["year[]"];
	var partylistSelect = document.forms["createBallot"]["partylist[]"];
	var uploadImage = document.forms["createBallot"]["photo[]"];

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
			alert("middle initial must only contain a letter");
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
		}
		if(uploadImage[i].value == ""){
			uploadImage[i].focus();
			alert("Please choose an image for the Candidate");
			return false;
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
$(document).ready(function (){
 
    
    $('.add').on('click',function(){
        $('<div class="cc"><input type="text" name="idnum[]" class="code" placeholder="ID number" maxlength="6"><input type="text" name="firstname[]" placeholder="First Name"><input type="text" name="middleinitial[]" placeholder="Middle Initial" maxlength="1"><input type="text" name="lastname[]" placeholder="Last Name"><select name="course[]"><option selected="selected" disabled value="">Course</option><option value="BA">BA</option><option value="CRIM">CRIM</option><option value="CHM">CHM</option><option value="EDUC">EDUC</option><option value="ENGINEERING">ENGINEERING</option><option value="ICT">ICT</option><option value="NURSING">NURSING</option></select><select name="year[]"><option selected="selected" disabled value="">Year</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select><input type="text" name="partylist[]" placeholder="Partylist"><input type="text" name="position[]" value="Councilor"><button type="button" class="remove"><i class="fa fa-times fa-1x"></i>Remove</button><br></div>').appendTo('.Councilors');
    });
    
    $(document).on('click','.remove', function (){
        $(this).parent('.cc').remove();
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