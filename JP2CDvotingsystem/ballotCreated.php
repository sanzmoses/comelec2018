<?php
session_start();
require 'connect_database.php';
include 'getResults.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}	

	$ballotExist = "";
	$sql = "SELECT * 	FROM candidates";
	$query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($query);
	if($count == 1){
		$ballotExist = '<p>Ballot has already been created</p>';
	}

?>
<?php 
	

?>
<!--DISPLAY TALLY-->
<?php 
	$display = "";
	$sql = "SELECT * FROM votes";
	$query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($query);
	if($count > 0){
		$display = '<div class="tally" id="tally">
					<h3>Today\'s Votes</h3>
					<span>*note:Official and final result will be available at the end of the election</span>
					<table class="tally">
					<tr>
						<th>Tally</th>
						<th colspan="5"></th>
					</tr>
					<tr>
						<td>ID number</td>
						<td>Name</td>
						<td>Partylist</td>
						<td>Votes</td>
						<td class="last">Status</td>
					</tr>
					<tr class="position">
							<td>President</td>
							<td colspan="5"></td>
							</tr>
					'
					. $presidentCount .'
					<tr class="position">
							<td>Vice-President Internal</td>
							<td colspan="5"></td>
							</tr>
					'
					. $vicepresidentinternalCount. '
					<tr class="position">
							<td>Vice-President External</td>
							<td colspan="5"></td>
							</tr>
					'
					. $vicepresidentexternalCount .'
					<tr class="position">
							<td>Vice-President Finance</td>
							<td colspan="5"></td>
							</tr>'
					. $vicepresidentfinanceCount .'
					<tr class="position">
							<td>Councilors</td>
							<td colspan="5"></td>
							</tr>'
					. $councilorCount .'
					</table>
					</div>';		
	}
	?>

<!---CHECK IF BALLOT HAS BEEN CREATED-->


<?php 
	$createBallot = "";
	$viewCandidates = "";
	$viewBallot = "";
	$viewVotes = "";
	$noBallot = "";
	$sql = "SELECT * FROM candidates";
	$query = mysqli_query($con,$sql);
	$numRows = mysqli_num_rows($query);
	if($numRows > 0){
		$createBallot = '<a href="">
							<div class="box boxa"> 
								<i class="fa fa-home fa-pencil-square-o fa-4x"></i>
								<p>Create Ballot</p>
								<p class="message">Ballot has already been created</p>
							</div>
						</a>';
		$viewVotes = '<a href="results.php">
						<div class="box boxb"> 
						<i class="fa fa-bar-chart fa-4x"></i>
						<p>View Votes</p>
						</div>
						</a>';
		$viewCandidates = '<a href="" alt="Edit Candidates" titile="weeeeeee">
							<div class="box boxc"> 
							<i class="fa fa-users fa-4x"></i>
							<p>View Candidates</p>
							</div>
							</a>';
		$viewBallot = '<a href="">
							<div class="box boxd"> 
							<i class="fa fa-user fa-4x"></i>
							<p>View Students</p>
							</div>
						</a>';
	}else {
		$createBallot = '<a href="">
							<div class="box boxa"> 
								<i class="fa fa-home fa-pencil-square-o fa-4x"></i>
								<span>Create Ballot</span>
							</div>
						</a>';
		$viewVotes = '<a href="">
						<div class="box boxb"> 
						<i class="fa fa-bar-chart fa-4x"></i>
						<p>View Votes</p>
						<p class="message">No Ballot created</p>
						</div>
						</a>';
		$viewCandidates = '<a href="">
							<div class="box boxc"> 
							<i class="fa fa-users fa-4x"></i>
							<p>View Candidates</p>
							<p class="message">No Ballot created</p>
							</div>
							</a>';
		$viewBallot = '<a href="">
							<div class="box boxd"> 
							<i class="fa fa-user fa-4x"></i>
							<p>View Students</p>
							</div>
						</a>';
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
		<li><a href="results.php"><i class="fa fa-bar-chart fa-1g"></i>Votes</a></li>
		<li><a href="about.php"><i class="fa fa-info fa-1g"></i>About</a></li>
	</ul>

</div>	
<div class="main-content">
	<h2>Ballot has already been created!</h2>
	
</div>
</form>
</body>
</html>

<script>
document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear();
}
</script>