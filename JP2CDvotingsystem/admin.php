<?php
session_start();
require 'connect_database.php';
include 'getResults.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}	
	
?>


<!--DISPLAY TALLY-->
<?php 
	$display = "";
	$sql = "SELECT * FROM votes";
	$query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($query);
	if($count > 0){
		$display = '<div class="tallyVotes" id="tally">
					<h3>Today\'s Votes</h3>
					<span>*note:Official and final result will be available at the end of the election</span><br>
					<h4>Total Number of Abstains: '.$abstainTotal.'</h4><br>
					<h4>Total number of Voters : '.$numberOfVotes.'</h4><br>
					<table class="tally">
					<tr>
						<th>Tally</th>
						<th colspan="3"></th>
					</tr>
					<tr>
						<td>Name</td>
						<td>Partylist</td>
						<td>ID number</td>
						<td style="padding-right: 20px;">Votes</td>
						
					</tr>
					<tr class="position">
							<td>President</td>
							<td colspan="3"></td>
							</tr>
					'
					. $presidentCount .'
					<tr class="position">
							<td>Vice-President Internal Affairs</td>
							<td colspan="3"></td>
							</tr>
					'
					. $vicepresidentinternalCount. '
					<tr class="position">
							<td>Vice-President External Affairs</td>
							<td colspan="3"></td>
							</tr>
					'
					. $vicepresidentexternalCount .'
					<tr class="position">
							<td>Vice-President Finance Affairs</td>
							<td colspan="3"></td>
							</tr>'
					. $vicepresidentfinanceCount .'
					<tr class="position">
							<td>Councilors</td>
							<td colspan="3"></td>
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
	$delete = "";
	$viewBallot = "";
	$viewVotes = "";
	$noBallot = "";

	$sqlVotes = "SELECT * FROM votes";
	$queryVotes = mysqli_query($con,$sqlVotes);
	$rowCountVotes = mysqli_num_rows($queryVotes);
	if($rowCountVotes ==  0){
		$viewVotes = '<a href="">
						<div class="box boxb"> 
						<i class="fa fa-bar-chart fa-4x"></i>
						<p>View Votes</p>
						<p class="message">Vote table is empty</p>
						</div>
						</a>';
	} else {
		$viewVotes = '<a href="results.php">
						<div class="box boxb"> 
						<i class="fa fa-bar-chart fa-4x"></i>
						<p>View Votes</p>
						</div>
						</a>';
	}

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
		$viewCandidates = '<a href="candidates.php" alt="Edit Candidates" titile="weeeeeee">
							<div class="box boxc"> 
							<i class="fa fa-users fa-4x"></i>
							<p>View Candidates</p>
							</div>
							</a>';
		
		
		$delete = '<button type="button" onclick="deleteFunction()">Start new election</button>';
	}else {
		$createBallot = '<a href="createballot.php">
							<div class="box boxa"> 
								<i class="fa fa-home fa-pencil-square-o fa-4x"></i>
								<span>Create Ballot</span>
								<p class="message">Click Here to create ballot</p>
							</div>
						</a>';
		
		$viewCandidates = '<a href="">
							<div class="box boxc"> 
							<i class="fa fa-users fa-4x"></i>
							<p>View Candidates</p>
							<p class="message">No Ballot created</p>
							</div>
							</a>';
		
	}
	

?>
<?php 
	$viewBallot = "";
	$sql = 'SELECT * FROM students WHERE passcode = "" ';
	$query = mysqli_query($con,$sql);
	$rows = mysqli_fetch_array($query);
	if($rows > 3 ){
		$viewBallot = '<a href="students.php">
							<div class="box boxd"> 
							<i class="fa fa-user fa-4x"></i>
							<p>View Students</p>
							<p class="message">passwords has been generated</p>
							</div>
						</a>';
	}else {
		$viewBallot = '<a href="import.php">
							<div class="box boxd"> 
							<i class="fa fa-user fa-4x"></i>
							<p>View Students</p>
							<p class="message">Student table is empty. Click here to import</p>
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
		<li><a href="students.php"><i class="fa fa-user fa-1g"></i>Students</a></li>
		<li><a href="about.php"><i class="fa fa-info fa-1g"></i>About</a></li>
	</ul>

</div>	
<div class="main-content">
		
		<?php echo $createBallot; ?>
		<?php echo $viewVotes;?>
		<?php echo $viewCandidates;?>
		<?php echo $viewBallot;?>
		<?php echo $delete; ?>
	<?php echo $display;?>
	 	
	
</div>
</form>
</body>
<style>
.tallyVotes {
	clear:left;
}
button{
	padding: 10px 15px 10px 15px;
	border:none;
	background:#3598dc;
	color:#fff;
}
button:hover {
	background:#1d8ad3;
}
</style>
</html>

<script>
function deleteFunction(){
	if(confirm("Are you sure you want to Start new election? doing so will delete the ballot and all votes ") == true){
		window.location="delete.php";
	}
	
}
//highlight ang winner
var president = $(".president");

if(parseInt(president.first().find("td:last").html()) > parseInt(president.last().find("td:last").html())){
	$(president.first().find("td:last")).css({"background":"#54c059","color":"#000"});
}else if(parseInt(president.first().find("td:last").html()) == parseInt(president.last().find("td:last").html())) {
	$(president.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var VPi = $(".VPi");

if(parseInt(VPi.first().find("td:last").html()) > parseInt(VPi.last().find("td:last").html())){
	$(VPi.first().find("td:last")).css({"background":"#54c059","color":"#000"});
}else if(parseInt(VPi.first().find("td:last").html()) == parseInt(VPi.last().find("td:last").html())) {
	$(VPi.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var VPe = $(".VPe");

if(parseInt(VPe.first().find("td:last").html()) > parseInt(VPe.last().find("td:last").html())){
	$(VPe.first().find("td:last")).css("background","#54c059");
}else if(parseInt(VPe.first().find("td:last").html()) == parseInt(VPe.last().find("td:last").html())) {
	$(VPe.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var VPf = $(".VPf");

if(parseInt(VPf.first().find("td:last").html()) > parseInt(VPf.last().find("td:last").html())){
	$(VPf.first().find("td:last")).css("background","#54c059");
}else if(parseInt(VPf.first().find("td:last").html()) == parseInt(VPf.last().find("td:last").html())) {
	$(VPf.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var councilor = $(".councilor");

	$(councilor.slice(0,6).find("td:last")).css({"background":"#54c059","color":"#000"});
	

document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear();
}
</script>