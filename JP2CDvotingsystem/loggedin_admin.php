<?php 
	function loggedin_admin(){
		if(isset($_SESSION["admin_login"]) && !empty($_SESSION['admin_login']) && isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"])){
			return true;
		}else {
			return false;
		}
	}
?>