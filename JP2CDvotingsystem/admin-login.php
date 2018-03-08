<?php 
	ob_start();
	session_start();
	require 'connect_database.php';
	require 'loggedin_admin.php';
	/*--------ADMIN SESSION--------------*/
	if(loggedin_admin()){
		header("location: admin.php");
	}
	/*----------*/
	//error Message//
	$errorMatch = "";
	if(isset($_POST["submit"])){
		$username =  mysqli_real_escape_string($con,$_POST["username"]);
		$password = mysqli_real_escape_string($con,$_POST["password"]);

		$query = "SELECT * FROM admin WHERE username = '$username'";
		$sql = mysqli_query($con,$query);
		$numrows = mysqli_num_rows($sql);
		if($numrows >=1 ){
			while($rows = mysqli_fetch_assoc($sql)){
				$result = $rows["password"];
				if($password == $result){
					$_SESSION["admin_id"] = $rows["id"];
					$_SESSION["admin_login"] = $rows["admin"];
					header("location: admin.php");
				}else {
					$errorMatch = "incorrect password";
				}
			}
		}else {
			$errorMatch = "username and password do not match";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" media="screen" />
<link rel="Stylesheet" href="Font-awesome/font-awesome-4.2.0/css/font-awesome.css" />
<link rel="stylesheet" href="normalize.css" / >
</head>
<title></title>
<body>
<div class="main-loginfrm">
	<h2 class="main-header">Admin Login</h2>
	<form class="adminfrm" name="loginfrm" method="POST" action="admin-login.php">
	

	<input type="text" id="username" name="username" placeholder="Username"/><br>
	<input type="password" name="password" placeholder="Password"/><br>
	<button type="submit" class="adminSubmitBtn" name="submit" value="submit"><i class="fa fa-sign-in fa-2x"></i><span>Login</span></button>
	<span class="errorMessage"><?php echo $errorMatch; ?></span>
	
	</form>
</div>
</body>
</html>

