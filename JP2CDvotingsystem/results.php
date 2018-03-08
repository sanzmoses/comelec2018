<?php
session_start();
require 'connect_database.php';
include 'getResults.php';

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["password"])){
		header("location: admin-login.php");
		exit();
	}	

?>
<?php 
	$sql = "SELECT * FROM votes";
	$query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($query);

	if($count == 0){
		header("location: admin.php");
	}

?>
<!--DISPLAY TALLY-->
<?php 
	$display = "";
	$sql = "SELECT * FROM votes";
	$query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($query);
	if($count > 0){
		$display = '<table class="tally">
					<tr>
						<th>Tally</th>
						<th colspan="5"></th>
					</tr>
					<tr>
						<td>Name</td>
						<td>Partylist</td>
						<td>ID number</td>
						<td style="padding-right: 30px;">Votes</td>
					</tr>
					<tr class="position">
							<td>President</td>
							<td colspan="3"></td>
							</tr>
					'
					. $presidentCount .'
					<tr class="position">
							<td>Vice-President Internal</td>
							<td colspan="3"></td>
							</tr>
					'
					. $vicepresidentinternalCount. '
					<tr class="position">
							<td>Vice-President External</td>
							<td colspan="3"></td>
							</tr>
					'
					. $vicepresidentexternalCount .'
					<tr class="position">
							<td>Vice-President Finance</td>
							<td colspan="3"></td>
							</tr>'
					. $vicepresidentfinanceCount .'
					<tr class="position">
							<td>Councilors</td>
							<td colspan="3"></td>
							</tr>'
					. $councilorCount .'
					</table>';		
	}
	?>
	<!--President-->

	<?php 
		$displayPercentageP = "";
		$sql = "SELECT president AS candidate,candidates.firstname, candidates.mi, candidates.lastname, candidates.partylist, count(*) / (SELECT count(*) FROM votes) * 100 AS percentage FROM votes INNER JOIN candidates ON president = candidates.id_number GROUP BY president ORDER BY percentage DESC";
		
		$query = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($query)){
				$candidate = $row["candidate"];
				$firstname = ucfirst($row["firstname"]);
				$middleinitial = ucfirst($row["mi"]);
				$lastname = ucfirst($row["lastname"]);
				$partylist = ucfirst($row["partylist"]);
				$percentage = number_format($row["percentage"],1); 
				$displayPercentageP .= '<h4>'.$firstname.' '.$middleinitial.'. '.$lastname.' </h4>
							<div class="bar">
							<div class="inner" style="width:'.$percentage.'%"><p class="value">'.$percentage.'%</p></div>
						  </div>';
			}
		
	?>
	<?php 
		$displayAbstainP = "";
		$sqlPresident = "SELECT president as candidate, COUNT(*) /(SELECT COUNT(*) FROM votes) * 100 AS percentage FROM votes WHERE president = 'abstain'";
		$queryPresident = mysqli_query($con,$sqlPresident);


		while($rowPresident = mysqli_fetch_array($queryPresident)){
			$abstainPresident = number_format($rowPresident["percentage"],1);
						$displayAbstainP = '<h4>Abstain</h4>
								<div class="bar">
									<div class="inner" style="width:'.$abstainPresident.'%;background:#e84c3d;"><p class="value">'.$abstainPresident .'%</p></div>
								</div>';
		
			
			
		}
		
	?>
	<!--VicePresidentInternal-->
	<?php 
		$displayPercentageVPi = "";
		$sql = "SELECT vicepresidentinternal AS candidate,candidates.firstname, candidates.mi, candidates.lastname, candidates.partylist, count(*) / (SELECT count(*) FROM votes) * 100 AS percentage FROM votes INNER JOIN candidates ON vicepresidentinternal = candidates.id_number GROUP BY vicepresidentinternal ORDER BY percentage DESC";
		
		$query = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($query)){
				$candidate = $row["candidate"];
				$firstname = ucfirst($row["firstname"]);
				$middleinitial = ucfirst($row["mi"]);
				$lastname = ucfirst($row["lastname"]);
				$partylist = ucfirst($row["partylist"]);
				$percentage = number_format($row["percentage"],1);
				$displayPercentageVPi .= '<h4>'.$firstname.' '.$middleinitial.'. '.$lastname.' </h4>
							<div class="bar">
							<div class="inner" style="width:'.$percentage.'%"><p class="value">'.$percentage.'%</p></div>
						  </div>';
			}
		
	?>
	<?php 
		$displayAbstainVPi = "";
		$sqlVPi = "SELECT vicepresidentinternal as candidate, COUNT(*) /(SELECT COUNT(*) FROM votes) * 100 AS percentage FROM votes WHERE vicepresidentinternal = 'abstain'";
		$queryVPi = mysqli_query($con,$sqlVPi);


		while($rowVPi = mysqli_fetch_array($queryVPi)){
			$abstainVPi = number_format($rowVPi["percentage"],1);
			$displayAbstainVPi = '<h4>Abstain</h4>
								<div class="bar">
									<div class="inner" style="width:'.$abstainVPi.'%;background:#e84c3d;"><p class="value">'.$abstainVPi.'%</p></div>
								</div>';
		
		}
		
	?>
	<!--Vice-President external-->
	<?php 
		$displayPercentageVPe = "";
		$sql = "SELECT vicepresidentexternal AS candidate,candidates.firstname, candidates.mi, candidates.lastname, candidates.partylist, count(*) / (SELECT count(*) FROM votes) * 100 AS percentage FROM votes INNER JOIN candidates ON vicepresidentexternal = candidates.id_number GROUP BY vicepresidentexternal ORDER BY percentage DESC";
		
		$query = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($query)){
				$candidate = $row["candidate"];
				$firstname = ucfirst($row["firstname"]);
				$middleinitial = ucfirst($row["mi"]);
				$lastname = ucfirst($row["lastname"]);
				$partylist = ucfirst($row["partylist"]);
				$percentage = number_format($row["percentage"],1);
				$displayPercentageVPe .= '<h4>'.$firstname.' '.$middleinitial.'. '.$lastname.' </h4>
							<div class="bar">
							<div class="inner" style="width:'.$percentage.'%"><p class="value">'.$percentage.'%</p></div>
						  </div>';
			}
		
	?>
	<?php 
		$displayAbstainVPe = "";
		$sqlVPe = "SELECT vicepresidentexternal as candidate, COUNT(*) /(SELECT COUNT(*) FROM votes) * 100 AS percentage FROM votes WHERE vicepresidentexternal = 'abstain'";
		$queryVPe = mysqli_query($con,$sqlVPe);


		while($rowVPe = mysqli_fetch_array($queryVPe)){
			$abstainVPe = number_format($rowVPe["percentage"],1);
			$displayAbstainVPe = '<h4>Abstain</h4>
								<div class="bar">
									<div class="inner" style="width:'.$abstainVPe.'%;background:#e84c3d;"><p class="value">'.$abstainVPe.'%</p></div>
								</div>';
		
		}
		
	?>
	<!--Vice-President finance-->
	<?php 
		$displayPercentageVPf = "";
		$sql = "SELECT vicepresidentfinance AS candidate,candidates.firstname, candidates.mi, candidates.lastname, candidates.partylist, count(*) / (SELECT count(*) FROM votes) * 100 AS percentage FROM votes INNER JOIN candidates ON vicepresidentfinance = candidates.id_number GROUP BY vicepresidentfinance ORDER BY percentage DESC";
		
		$query = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($query)){
				$candidate = $row["candidate"];
				$firstname = ucfirst($row["firstname"]);
				$middleinitial = ucfirst($row["mi"]);
				$lastname = ucfirst($row["lastname"]);
				$partylist = ucfirst($row["partylist"]);
				$percentage = number_format($row["percentage"],1);
				$displayPercentageVPf .= '<h4>'.$firstname.' '.$middleinitial.'. '.$lastname.' </h4>
							<div class="bar">
							<div class="inner" style="width:'.$percentage.'%"><p class="value">'.$percentage.'%</p></div>
						  </div>';
			}
		
	?>
	<?php 
		$displayAbstainVPf = "";
		$sqlVPf = "SELECT vicepresidentfinance as candidate, COUNT(*) /(SELECT COUNT(*) FROM votes) * 100 AS percentage FROM votes WHERE vicepresidentfinance = 'abstain'";
		$queryVPf = mysqli_query($con,$sqlVPf);


		while($rowVPf = mysqli_fetch_array($queryVPf)){
			$abstainVPf = number_format($rowVPf["percentage"],1);
			$displayAbstainVPf = '<h4>Abstain</h4>
								<div class="bar">
									<div class="inner" style="width:'.$abstainVPf.'%;background:#e84c3d;"><p class="value">'.$abstainVPf.'%</p></div>
								</div>';
		
		}
		
	?>
	<!--VOTES for councilors-->
	<?php 
	$sql = "SELECT councilor1, candidates.firstname, candidates.mi, candidates.lastname, 
	candidates.partylist, SUM(total) AS total FROM (SELECT DISTINCT councilor1, COUNT(*)
	as total FROM votes GROUP BY councilor1 UNION ALL SELECT DISTINCT councilor2, COUNT(*)
	as total FROM votes GROUP BY councilor2 UNION ALL SELECT DISTINCT councilor3, COUNT(*)
	as total FROM votes GROUP BY councilor3 UNION ALL SELECT DISTINCT councilor4, COUNT(*)
	as total FROM votes GROUP BY councilor4 UNION ALL SELECT DISTINCT councilor5, COUNT(*)
	as total FROM votes GROUP BY councilor5 UNION ALL SELECT DISTINCT councilor6, COUNT(*)
	as total FROM votes GROUP BY councilor6) AS u INNER JOIN candidates ON councilor1 = 
	candidates.id_number GROUP BY councilor1 ORDER BY total DESC";
	$query = mysqli_query($con,$sql);

	$displayCouncilor = "";
	$displayAbstainsCouncilor = "";
	while($row = mysqli_fetch_array($query)){
		$idnum = $row["councilor1"];
		$count = $row["total"];
		$percentage = number_format(($count / $numberOfVotes) * 100);
		$firstname = ucfirst($row["firstname"]);
		$middleinitial = ucfirst($row["mi"]);
		$lastname = ucfirst($row["lastname"]);
		$partylist = ucfirst($row["partylist"]);
		$displayCouncilor .= '<li><h4>'.$firstname.' '.$middleinitial.'. '.$lastname.'</h4></li>
							<div class="bar">
							<div class="inner" style="width:'.$percentage.'%"><p class="value">'.$percentage.'%</p></div>
						  </div>';
	}
	$displayAbstainsCouncilor = '<h4>Abstains</h4>
								<div class="bar">
									<div class="inner" style="width:'.number_format($numberOfVotes).'%;background:#e84c3d;"><p class="value">'.number_format($numberOfVotes).'%</p></div>
								</div>';
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
<img src="images/222.png" width="190" height="190" style="margin: 15px 0 0 10px;">
	<ul>
		<li><a href="admin.php"><i class="fa fa-home fa-1g"></i>Home</a></li>
		<li><a href="candidates.php"><i class="fa fa-users fa-1g"></i>Candidates</a></li>
		<li><a href="results.php"><i class="fa fa-bar-chart fa-1g"></i>Votes</a></li>
		<li><a href="students.php"><i class="fa fa-user fa-1g"></i>Students</a></li>
		<li><a href="about.php"><i class="fa fa-info fa-1g"></i>About</a></li>
	</ul>

</div>	
<div class="main-content">
	<h2>VOTES</h2>
	<!--Vote for President-->
	<h4>Total number of voters : <?php echo $numberOfVotes; ?></h4><br>
	<h4>Total number who did not vote: <?php echo $totalDidnotvote; ?><h4>
	<a href="DOCU.php">Print preview of Results</a>

	<?php echo $display;?>

	<div class="results president">
	<h3>President</h3>
	<?php echo $displayPercentageP; ?>
	<?php echo $displayAbstainP; ?>
	</div>
	<!--END-->
	
	<!--Vote For Vice-president internal-->
	<div class="results VPi">
	<h3>Vice-President Internal Affairs</h3>
	<?php echo $displayPercentageVPi; ?>
	<?php echo $displayAbstainVPi; ?>
	</div>
	<!--Votes FOR Vice-president External-->
	<div class="results VPe">
	<h3>Vice-President External Affairs</h3>
	<?php echo $displayPercentageVPe; ?>
	<?php echo $displayAbstainVPe; ?>
	</div>
	<!--Votes FOR Vice-president Finance-->
	<div class="results VPf">
	<h3>Vice-President Finance Affairs</h3>
	<?php echo $displayPercentageVPf; ?>
	<?php echo $displayAbstainVPf; ?>
	</div>
	<!--Votes for Councilors-->
	<div class="results Councilors">
	<h3>Councilors<h3>
	<ol>
	<?php echo $displayCouncilor; ?>
	
	</ol>
	</div>


</div>
</form>
</body>
<style>
	button {
		margin-top: 20px;
		border:none;
		width: 210px;
		height: 40px;
		background:#3598dc;	
	}
	.main-content {
		min-height: 100%;
	}
	.results {
		width: 40em;
		border:1px solid #535353;
		margin-bottom: 15px;
		padding: 15px;
		min-height: 100%;
	}
	.results h3 {
		margin-bottom: 10px;
	}
	.bar {
		display:block;
		width: 600px;
		height: 40px;
		margin-bottom:15px;
	}
	.inner {
		display:block;
		height: 40px;
		background:#5fd863;
		overflow:hidden;
	}
	.value {
		font-family:'lato-Light';
		float:right;
		margin-top:10px;
		margin-right: 10px;
	}
	table {
		margin-bottom: 30px;
	}

</style>
</html>

<script>

var president = $(".president");

if(parseInt(president.first().find("td:last").html()) > parseInt(president.eq(1).find("td:last").html()) ){
	$(president.first().find("td:last")).css({"background":"#54c059","color":"#000"});
}else if(parseInt(president.first().find("td:last").html()) == parseInt(president.eq(1).find("td:last").html())) {
	$(president.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var VPi = $(".VPi");

if(parseInt(VPi.first().find("td:last").html()) > parseInt(VPi.eq(1).find("td:last").html()) ){
	$(VPi.first().find("td:last")).css({"background":"#54c059","color":"#000"});
}else if(parseInt(VPi.first().find("td:last").html()) == parseInt(VPi.eq(1).find("td:last").html())) {
	$(VPi.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var VPe = $(".VPe");

if(parseInt(VPe.first().find("td:last").html()) > parseInt(VPe.eq(1).find("td:last").html()) ){
	$(VPe.first().find("td:last")).css({"background":"#54c059","color":"#000"});
}else if(parseInt(VPe.first().find("td:last").html()) == parseInt(VPe.eq(1).find("td:last").html())) {
	$(VPe.find("td:last")).css({"background" : "#ff6347", "color":"#000"});
}

var VPf = $(".VPe");

if(parseInt(VPf.first().find("td:last").html()) > parseInt(VPf.eq(1).find("td:last").html()) ){
	$(VPf.first().find("td:last")).css({"background":"#54c059","color":"#000"});
}else if(parseInt(VPf.first().find("td:last").html()) == parseInt(VPf.eq(1).find("td:last").html())) {
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