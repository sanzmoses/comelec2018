<?php
	ob_start();
	session_start();
	require 'connect_database.php';
	require 'loggedin.php';
	if (loggedin()){
		header("Location: vote.php");
	}
	$errorMatch ="";
	if(isset($_POST["submit"])){
		$idnum = mysqli_real_escape_string($con,$_POST["idnum"]);
		$password = mysqli_real_escape_string($con,$_POST["password"]);

		$sqlCheck = "SELECT * FROM votes WHERE voter = '$idnum'";
		$queryCheck = mysqli_query($con,$sqlCheck);
		$rowCheck = mysqli_num_rows($queryCheck);
		if($rowCheck > 0){
				$errorMatch = "Sorry, it appears the ID number has already voted.";
		}else {
		$query = "SELECT * FROM students WHERE ID_number = '$idnum'";
		$sql = mysqli_query($con,$query);
		$numrows = mysqli_num_rows($sql);
		if($numrows >= 1){
			while($rows = mysqli_fetch_assoc($sql)){
				$result = $rows["passcode"];
				if($password == $result ){
					$_SESSION["student_id"] = $rows["ID_number"];
					$_SESSION["student_login"] = $rows["passcode"];
					$_SESSION["name"] = $rows["last_name"] .', '. $rows["first_name"];

					header("Location: vote.php");
				}else {
					$errorMatch = "incorrect passcode";
				}
			}
		}else {
			$errorMatch = "ID number and password do not match";
		}
		}
	}

?>
<?php
	$sql = "SELECT * FROM candidates";
	$query = mysqli_query($con,$sql);
	$numRows = mysqli_num_rows($query);
	if($numRows == 0){
		header("location: electionStop.php ");
		exit();
	}
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" media="screen" />
<link rel="stylesheet" href="normalize.css" />
<link rel="Stylesheet" href="Font-awesome/font-awesome-4.3.0/css/font-awesome.css" />
<script src="js/jquery-1.11.2.js"></script>
</head>
<body id="index3">
		<div class="nav-bar"><img class="img-1" src="images/comelec_logo.png" width="70" height="70"/><img class="img-2" src="images/ssc_logo.png" width="70" height="70"/><p>SSC ELECTION <?php echo date("Y"); ?></p></div>
<form class="loginfrm" name="loginfrm" method="POST" action="index.php" onsubmit="return validation();">
	<input type="text" id="idnum" name="idnum" class="code" maxlength="8" placeholder="ID number ex.20140000" autocomplete="off" /><br>
	<input type="password" id="password" name="password" maxlength="6" placeholder="Password" autocomplete="off"/><br>
	<button type="submit" name="submit" value="submit"><i class="fa fa-sign-in fa-2x"></i><span>ENTER</span></button>
	<span class="errorMessage"><?php echo $errorMatch; ?></span>
	<img class="jp2cdlogo" src="images/222.png" width="130" height="130" >
</form>
</body>
</html>
<script>
function validation(){
	var idnum = document.getElementById("idnum");
	var password = document.getElementById("password");

	if(idnum.value == ""){
		idnum.focus();
		alert("Please fill ID number");
		return false;
	}else if (idnum.value.length < 8){
		idnum.focus();
		alert("ID number must have exactly 9 digits");
		return false;
	}

	if(password.value == ""){
		password.focus();
		alert("Please fill password");
		return false;
	}else if (password.value.length < 6){
		password.focus();
		alert("password must be 6 characters");
		return false;
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

    });

    console.log("refreshing after 10 seconds!");
    var time = window.setTimeout(function (){
    	location.href = "index.php";
    }, 10000);

    $("#idnum").focus(function(){
    	console.log("Stop Window Refresh!");
    	clearTimeout(time);
    });

});
</script>
