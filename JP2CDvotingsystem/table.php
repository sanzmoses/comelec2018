
<?php
	
	session_start();
	require 'connect_database.php';
	if(!isset($_SESSION["student_id"]) && !isset($_SESSION["student_login"])){
		header("location: index3.php");
		exit();
	}	
	$sql = "SELECT * FROM admin WHERE BallotCreated ='yes'";
	$query = mysqli_query($con, $sql);
	$rowCount = mysqli_num_rows($query);
	if(!$rowCount > 1){
		header("location: index3.php");
	}
	require 'getCandidates.php';
	require 'getVotes.php';
	
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" media="screen" />	
<link rel="Stylesheet" href="Font-awesome/font-awesome-4.3.0/css/font-awesome.css" />	

</head>
<title>SSC Election <?php 
	echo date("Y");
?></title>
<script src="js/jquery-1.11.2.js"></script>
<body>
<div class="vote-main">
	<form class="vote-form" name="vote-form" method="POST" action="vote.php" onsubmit="return validation();">
		
		<table class="voteTable">
  <tr class="header">
    <td class="position"><h3>President</h3></<td>
      <td colspan="4"></td>
  </tr>
  <?php echo $candidatePresident; ?>
   <tr>
    <td class="candidate">Vincent B. Agudera</<td>
      <td class="radio"><input type="radio"></td>
  </tr>
  <tr>
    <td class="candidate">ediw0wdsadasdasdasdasdasdas</<td>
      <td class="radio"><input type="radio"></td>
    </tr>
     <tr class="header">
    <td class="position"><h3>Vice-President</h3></<td>
      <td colspan="4"></td>
  </tr>
   <tr>
    <td class="candidate">dasdasdas</<td>
      <td class="radio">radio</td>
  
  </tr>
  <tr>
    <td class="candidate">ediw0w</<td>
      <td class="radio">radio</td>
  </tr>
  
   
</table>

	</form>
</div>
</form>
</body>
<style>
body {
	background:#248bcc;
}

</style>
</html>
<script>

function validation (){	
		var countRadio = $("input[type='radio']:checked").length;
		if (countRadio < 3){
			$('#Message').html("Please vote for President, Vice-President Internal and Vice-President External");
				return false;
		}

		var count = $("input[type='checkbox']:checked").length;
		if (count < 7){
			$('#Message').html("please vote atleast 7 candidates");
			return false;
		}

		
		
}

	$("input[type=checkbox]").change(function(){
    	var max= 7;
    	if( $("input[type=checkbox]:checked").length == max ){
        	$("input[type=checkbox]").attr('disabled', 'disabled');
        	$("input[type=checkbox]:checked").removeAttr('disabled');
    	}else{
         	$("input[type=checkbox]").removeAttr('disabled');
    	}
	})

</script>