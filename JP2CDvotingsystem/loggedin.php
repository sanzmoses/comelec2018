<?php 
	function loggedin(){
		if(isset($_SESSION["student_login"]) && !empty($_SESSION['student_login']) && isset($_SESSION["student_id"]) && !empty($_SESSION["student_id"])){
			return true;
		}else {
			return false;
		}
	}
?>