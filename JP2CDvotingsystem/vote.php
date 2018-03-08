<?php
	session_start();
	require 'connect_database.php';
	if(!isset($_SESSION["student_id"]) && !isset($_SESSION["student_login"])){
		header("location: index.php");
		exit();
	}

	require 'getCandidates.php';
	require 'getVotes.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../plugins/jquery.js"></script>
<script type="text/javascript" src="../plugins/bootstrap3_js.min.js"></script>
<link rel="stylesheet" href="style.css" media="screen" />
<link rel="Stylesheet" href="Font-awesome/font-awesome-4.3.0/css/font-awesome.css" />
<link rel="stylesheet" href="../plugins/bootstrap3.min.css">
<title>SSC ELECTION 2017 | Vote</title>
</head>
<title>SSC Election <?php
	echo date("Y");
?></title>
<script src="js/jquery-1.11.2.js"></script>
<body class="vote-page">
<div class="vote-main">
	<div class="nav-bar-vote"><img class="img-1" src="images/comelec_logo.png" width="70" height="70"/><img class="img-2" src="images/ssc_logo.png" width="70" height="70"/><p>SSC ELECTION <?php echo date("Y"); ?></p></div>
	<form class="vote-form" name="vote-form" method="POST" action="vote.php" onsubmit="return validation();">

		<table class="voteTable">
			 <tr class="header">
    			<td class="position"><h3>President</h3></<td>
     			 <td colspan="3" style="border:5"></td>
  			</tr>
 			<?php echo $candidatePresident; ?>
 			<tr class="abstain-row">
 			<td><h2 class="text-default"><b>Abstain</b></h2></td>
 			<td class="pull-right"><input class="radio-abs" type="radio" name="President" value="abstain"></td>
 			</tr>
 			 <tr class="header">
    			<td class="position"><h3>Vice-President Internal</h3></<td>
     			 <td colspan="4"></td>
  			</tr>
 			<?php echo $candidateVPi;?>
 			<tr>
 			<td><h2 class="text-default"><b>Abstain</b></h2></td>
 			<td class="pull-right"><input class="radio-abs" type="radio" name="Vice-president(internal)" value="abstain"></td>
 			</tr>
 			 <tr class="header">
    			<td class="position"><h3>Vice-President External</h3></<td>
     			 <td colspan="3"></td>
  			</tr>
 			<?php echo $candidateVPe;?>
 			<tr>
 			<td><h2 class="text-default"><b>Abstain</b></h2></td>
 			<td class="pull-right"><input class="radio-abs" type="radio" name="Vice-president(external)" value="abstain"></td>
 			</tr>
			<tr class="header">
    			<td class="position"><h3>Vice-President Finance</h3></<td>
     			 <td colspan="3"></td>
  			</tr>
 			<?php echo $candidateVPf;?>
 			<tr>
 			<td><h2 class="text-default"><b>Abstain</b></h2></td>
			<td class="pull-right"><input class="radio-abs" type="radio" name="Vice-president(finance)" value="abstain"></td>
 			</tr>
 			 <tr class="header">
    			<td class="position"><h3>Councilor</h3> <h4>Please vote a maximum of 7 Councilors. You can choose to abstain.</h4></td>
     			 <td colspan="3"></td>
  			</tr>

 			<?php echo $candidateCouncilors;?>

		</table>

		<button type="submit" class="submit-btn" name="submit" value="submit" style="margin-bottom: 10px">
			<i class="fa fa-paper-plane fa-1g"></i>
			<span>Submit</span>
		</button>
		<div id="Message"></div>
	</form>
</div>
</form>
</body>
</html>
<script>

function validation(){
		var countRadio = $("input[type='radio']:checked").length;
		if (countRadio < 3){
			alert("Please vote a President , Vice-president Internal , Vice-president external and Vice-President finance");
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
