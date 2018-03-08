<?php 

	if(isset($_POST["submit"])){
		$student_id = mysqli_real_escape_string($con,$_SESSION["student_id"]);
		$President = mysqli_real_escape_string($con,$_POST["President"]);
		$vicePresidentInternal = mysqli_real_escape_string($con,$_POST["Vice-president(internal)"]);
		$vicePresidentExternal = mysqli_real_escape_string($con,$_POST["Vice-president(external)"]);
		$vicePresidentFinance = mysqli_real_escape_string($con,$_POST["Vice-president(finance)"]);
		$Councilor = $_POST["Councilor"];
			
		for($i =0; $i < 13; $i++){
			
			if(empty($Councilor[$i])){
				$Councilor[$i] = "abstain";
			}
		}
		
		if(empty($student_id)){
			header("location: index.php");
		}else {
			$sql = "INSERT INTO votes(voter,president,vicepresidentinternal,vicepresidentexternal,vicepresidentfinance,councilor1,councilor2,councilor3,councilor4,councilor5,councilor6,councilor7,councilor8,councilor9,councilor10,councilor11,councilor12,date) VALUES ('$student_id','$President','$vicePresidentInternal','$vicePresidentExternal','$vicePresidentFinance','$Councilor[0]','$Councilor[1]','$Councilor[2]','$Councilor[3]','$Councilor[4]','$Councilor[5]','$Councilor[6]','$Councilor[7]','$Councilor[8]','$Councilor[9]','$Councilor[10]','$Councilor[11]',Now())";
			$query = mysqli_query($con,$sql);
			//insert kung nka vote na
			$sql2 ="UPDATE students SET vote = 'yes' WHERE ID_number = '$student_id'";
			$query2 = mysqli_query($con,$sql2);
			
			if($query){
				unset($_SESSION["student_id"]);
				unset($_SESSION["student_login"]);
				header("Location: Voted.php");
			}else {
				echo 'error';
			}
		}
	}

?>	