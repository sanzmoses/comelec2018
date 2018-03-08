<?php 

	$sql = "SELECT DISTINCT votes.president, COUNT(*) as total, candidates.firstname,candidates.mi, candidates.lastname, candidates.partylist FROM votes INNER JOIN candidates ON votes.president = candidates.id_number GROUP BY president ORDER BY total DESC";
	$query = mysqli_query($con,$sql);
	$presidentCount = "";
	$i = 1;
	while($row = mysqli_fetch_array($query)){
		$idnum = $row["president"];
		$count = $row["total"];
		$firstname = ucfirst($row["firstname"]);
		$middleinitial = ucfirst($row["mi"]);
		$lastname = strtoupper($row["lastname"]);
		$partylist = ucfirst($row["partylist"]);
		$presidentCount .= '<tr class="candidates president">
							<td>'.$i++.'.) ' . $lastname .', '.$firstname.' '.$middleinitial. '.</td>
							<td>' .$partylist .'</td>
							<td>'. $idnum .'</td>
							<td>'. $count . '</td>
							</tr>';
	}
?>
<?php 
	
	$sql = "SELECT DISTINCT votes.vicepresidentinternal, COUNT(*) as total, candidates.firstname,candidates.mi, candidates.lastname, candidates.partylist FROM votes INNER JOIN candidates ON votes.vicepresidentinternal = candidates.id_number GROUP BY vicepresidentinternal ORDER BY total DESC";
	$query = mysqli_query($con,$sql);
	$vicepresidentinternalCount = "";
	$i =1;
	while($row = mysqli_fetch_array($query)){
		$idnum = $row["vicepresidentinternal"];
		$count = $row["total"];
		$firstname = ucfirst($row["firstname"]);
		$middleinitial = ucfirst($row["mi"]);
		$lastname = strtoupper($row["lastname"]);
		$partylist = ucfirst($row["partylist"]);
		$vicepresidentinternalCount .= '<tr class="candidates VPi">
							<td>'.$i++.'.) ' . $lastname .', '.$firstname.' '.$middleinitial. '.</td>
							<td>' .$partylist .'</td>
							<td>'. $idnum .'</td>
							<td>'. $count . '</td>
							</tr>';
	}
?>
<?php 
	$sql = "SELECT DISTINCT votes.vicepresidentexternal, COUNT(*) as total, candidates.firstname,candidates.mi, candidates.lastname, candidates.partylist FROM votes INNER JOIN candidates ON votes.vicepresidentexternal = candidates.id_number GROUP BY vicepresidentexternal ORDER BY total DESC";
	$query = mysqli_query($con,$sql);
	$vicepresidentexternalCount = "";
	$i =1;
	while($row = mysqli_fetch_array($query)){
		$idnum = $row["vicepresidentexternal"];
		$count = $row["total"];
		$firstname = ucfirst($row["firstname"]);
		$middleinitial = ucfirst($row["mi"]);
		$lastname = strtoupper($row["lastname"]);
		$partylist = ucfirst($row["partylist"]);

		$vicepresidentexternalCount .= '<tr class="candidates VPe">
							<td>'.$i++.'.) ' . $lastname .', '.$firstname.' '.$middleinitial. '.</td>
							<td>' .$partylist .'</td>
							<td>'. $idnum .'</td>
							<td>'. $count . '</td>
							</tr>';
	}
?>
<?php 
	$sql = "SELECT DISTINCT votes.vicepresidentfinance, COUNT(*) as total, candidates.firstname,candidates.mi, candidates.lastname, candidates.partylist FROM votes INNER JOIN candidates ON votes.vicepresidentfinance = candidates.id_number GROUP BY vicepresidentfinance ORDER BY total DESC";
	$query = mysqli_query($con,$sql);
	$vicepresidentfinanceCount = "";
	$i =1;
	while($row = mysqli_fetch_array($query)){
		$idnum = $row["vicepresidentfinance"];
		$count = $row["total"];
		$firstname = ucfirst($row["firstname"]);
		$middleinitial = ucfirst($row["mi"]);
		$lastname = strtoupper($row["lastname"]);
		$partylist = ucfirst($row["partylist"]);

		$vicepresidentfinanceCount .= '<tr class="candidates VPf">
							<td>'.$i++.'.) ' . $lastname .', '.$firstname.' '.$middleinitial. '.</td>
							<td>' .$partylist .'</td>
							<td>'. $idnum .'</td>
							<td>'. $count . '</td>
							</tr>';
	}
?>
<?php 

	
	$sql = "SELECT councilor1, candidates.firstname, candidates.mi, candidates.lastname, candidates.partylist, 
	SUM(total) AS total FROM (SELECT DISTINCT councilor1, COUNT(*) as total FROM votes GROUP BY councilor1 
	UNION ALL SELECT DISTINCT councilor2, COUNT(*) as total FROM votes GROUP BY councilor2 
	UNION ALL SELECT DISTINCT councilor3, COUNT(*) as total FROM votes GROUP BY councilor3 
	UNION ALL SELECT DISTINCT councilor4, COUNT(*) as total FROM votes GROUP BY councilor4 
	UNION ALL SELECT DISTINCT councilor5, COUNT(*) as total FROM votes GROUP BY councilor5 
	UNION ALL SELECT DISTINCT councilor6, COUNT(*) as total FROM votes GROUP BY councilor6
	UNION ALL SELECT DISTINCT councilor7, COUNT(*) as total FROM votes GROUP BY councilor7) 
	AS u INNER JOIN candidates ON councilor1 = candidates.id_number GROUP BY councilor1 ORDER BY total DESC";
	$query = mysqli_query($con,$sql);
	$councilorCount = "";
	$count = mysqli_num_rows($query);
	$i =1;
	while($row = mysqli_fetch_array($query)){
		$idnum = $row["councilor1"];
		$count = $row["total"];
		$firstname = ucfirst($row["firstname"]);
		$middleinitial = ucfirst($row["mi"]);
		$lastname = strtoupper($row["lastname"]);
		$partylist = ucfirst($row["partylist"]);
		$councilorCount .= '<tr class="candidates councilor">
							<td>'.$i++.'.) ' . $lastname .', '.$firstname.' '.$middleinitial. '.</td>
							<td>' .$partylist .'</td>
							<td>'. $idnum .'</td>
							<td>'. $count . '</td>
							</tr>';
	}
	
	
?>
<?php 
	$abstainCount = "";
	$sql ="SELECT president as Abstains, SUM(total) as total FROM (SELECT DISTINCT president, 
	COUNT(*) as total FROM votes WHERE president = 'abstain' UNION ALL SELECT DISTINCT vicepresidentinternal, 
	COUNT(*) as total FROM votes WHERE vicepresidentinternal = 'abstain' UNION ALL SELECT DISTINCT vicepresidentexternal, 
	COUNT(*) as total FROM votes WHERE vicepresidentexternal = 'abstain' UNION ALL SELECT DISTINCT vicepresidentfinance, 
	COUNT(*) as total FROM votes WHERE vicepresidentfinance  = 'abstain' UNION ALL SELECT DISTINCT councilor1, 
	COUNT(*) as total FROM votes WHERE councilor1 = 'abstain' UNION ALL SELECT DISTINCT councilor2, 
	COUNT(*) as total FROM votes WHERE councilor2 = 'abstain' UNION ALL SELECT DISTINCT councilor3, 
	COUNT(*) as total FROM votes WHERE councilor3 = 'abstain' UNION ALL SELECT DISTINCT councilor4,
	COUNT(*) as total FROM votes WHERE councilor4 = 'abstain' UNION ALL SELECT DISTINCT councilor5, 
	COUNT(*) as total FROM votes WHERE councilor5 = 'abstain' UNION ALL SELECT DISTINCT councilor6, 	
	COUNT(*) as total FROM votes WHERE councilor6 = 'abstain' ) as u GROUP BY Abstains ORDER BY TOTAL ASC";

	$query = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($query)){
		$abstainTotal = $row["total"];

	}

?>
<?php 
	$sql = "SELECT COUNT(*) as total FROM votes";
	$query = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($query)){
		$numberOfVotes = $row["total"];
	}
?>
<?php 
	$totalDidnotvote = "";
	$sql = "SELECT COUNT(*) As Votes FROM students WHERE vote= ' '";
	$query = mysqli_query($con,$sql);
	$rowCount = mysqli_num_rows($query);
	if($rowCount > 0){
		while($row = mysqli_fetch_array($query)){
			$totalDidnotvote = $row["Votes"];
		}
	}

?>