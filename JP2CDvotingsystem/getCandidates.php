<?php
	/*--------------PRESIDENT------------------*/
	/*------STUDENT ID --> STUDENT ID NUMBER--------*/
	$candidatePresident = "";
	if(isset($_SESSION["student_id"])){
		$query = "SELECT * FROM candidates WHERE position='President'";
		$sql = mysqli_query($con,$query);
		$count = mysqli_num_rows($sql);
		if($count >= 1){
			while($rows = mysqli_fetch_array($sql)){
				$id_number = $rows["id_number"];
				$firstname = ucfirst($rows["firstname"]);
				$lastname = ucfirst($rows["lastname"]);
				$mi = ucfirst($rows["mi"]);
				$course = ucfirst($rows["course"]);
				$partylist = ucfirst($rows["partylist"]);
				$position = ucfirst($rows["position"]);
				$candidatePresident .= '<tr>
  			  					<td class="candidate"><img class="img-can" src="images/'.$id_number.'.jpg" width="120" height="120" id="rotatepic"><h4 class="text-default">Name: <b>'.$firstname.' '.$mi.'. '.$lastname.'</b>&nbsp<span class="partylist">Course: <b>'.$course.'</b><span class="partylist">Partylist: <b>('.$partylist.')</b></h4></td>
     		  					<td class=" pull-right"><input class="radio-can" type="radio" name="'.$position.'" value="'									.$id_number.'"></td>
 								 </tr>';
			}
		}
	}


?>
<?php
	/*-------VICE_PRESIDENT INTERNAL----*/
	/*------STUDENT ID --> STUDENT ID NUMBER--------*/
	$candidateVPi = "";
	if(isset($_SESSION["student_id"])){
		$query = "SELECT * FROM candidates WHERE position='Vice-president(internal)'";
		$sql = mysqli_query($con,$query);
		$count = mysqli_num_rows($sql);
		if($count >= 1){
			while($rows = mysqli_fetch_array($sql)){
				$id_number = $rows["id_number"];
				$firstname = ucfirst($rows["firstname"]);
				$lastname = ucfirst($rows["lastname"]);
				$mi = ucfirst($rows["mi"]);
				$course = ucfirst($rows["course"]);
				$partylist = ucfirst($rows["partylist"]);
				$position = ucfirst($rows["position"]);
				$candidateVPi .= '<tr>
  			  					<td class="candidate"><img class="img-can" src="images/'.$id_number.'.jpg" width="120" height="120" id="rotatepic"><h4 class="text-default">Name: <b>'.$firstname.' '.$mi.'. '.$lastname.'</b>&nbsp<span class="partylist">Course: <b>'.$course.'</b><span class="partylist">Partylist: <b>('.$partylist.')</b></h4></td>
     		  					<td class=" pull-right"><input class="radio-can" type="radio" name="'.$position.'" value="'									.$id_number.'"></td>
 								 </tr>';
			}
		}
	}


?>
<?php
	/*-------VICE_PRESIDENT EXTERNAL----*/
	/*------STUDENT ID --> STUDENT ID NUMBER--------*/
	$candidateVPe = "";
	if(isset($_SESSION["student_id"])){
		$query = "SELECT * FROM candidates WHERE position='Vice-president(external)'";
		$sql = mysqli_query($con,$query);
		$count = mysqli_num_rows($sql);
		if($count >= 1){
			while($rows = mysqli_fetch_array($sql)){
				$id_number = $rows["id_number"];
				$firstname = ucfirst($rows["firstname"]);
				$lastname = ucfirst($rows["lastname"]);
				$mi = ucfirst($rows["mi"]);
				$course = ucfirst($rows["course"]);
				$partylist = ucfirst($rows["partylist"]);
				$position = ucfirst($rows["position"]);
				$candidateVPe .= '<tr>
  			  					<td class="candidate"><img class="img-can" src="images/'.$id_number.'.jpg" width="120" height="120" id="rotatepic"><h4 class="text-default">Name: <b>'.$firstname.' '.$mi.'. '.$lastname.'</b>&nbsp<span class="partylist">Course: <b>'.$course.'</b><span class="partylist">Partylist: <b>('.$partylist.')</b></h4></td>
     		  					<td class=" pull-right"><input class="radio-can" type="radio" name="'.$position.'" value="'									.$id_number.'"></td>
 								 </tr>';
			}
		}
	}


?>
<?php
	/*-------VICE_PRESIDENT FINANCE----*/
	/*------STUDENT ID --> STUDENT ID NUMBER--------*/
	$candidateVPf = "";
	if(isset($_SESSION["student_id"])){
		$query = "SELECT * FROM candidates WHERE position='Vice-president(finance)'";
		$sql = mysqli_query($con,$query);
		$count = mysqli_num_rows($sql);
		if($count >= 1){
			while($rows = mysqli_fetch_array($sql)){
				$id_number = $rows["id_number"];
				$firstname = ucfirst($rows["firstname"]);
				$lastname = ucfirst($rows["lastname"]);
				$mi = ucfirst($rows["mi"]);
				$course = ucfirst($rows["course"]);
				$partylist = ucfirst($rows["partylist"]);
				$position = ucfirst($rows["position"]);
				$candidateVPf .= '<tr>
  			  					<td class="candidate"><img class="img-can" src="images/'.$id_number.'.jpg" width="120" height="120"><h4 class="text-default">Name: <b>'.$firstname.' '.$mi.'. '.$lastname.'</b>&nbsp<span class="partylist">Course: <b>'.$course.'</b><span class="partylist">Partylist: <b>('.$partylist.')</b></h4></td>
     		  					<td class=" pull-right"><input class="radio-can" type="radio" name="'.$position.'" value="'									.$id_number.'"></td>
 								 </tr>';
			}
		}
	}


?>
<?php
	$candidateCouncilors = "";
	if(isset($_SESSION["student_id"])){
		$query = "SELECT * FROM candidates WHERE position='Councilor' ORDER BY RAND()";
		$sql = mysqli_query($con,$query);
		$count = mysqli_num_rows($sql);
		if($count >= 1){
			while($rows = mysqli_fetch_array($sql)){
				$id_number = $rows["id_number"];
				$firstname = ucfirst($rows["firstname"]);
				$lastname = ucfirst($rows["lastname"]);
				$mi = ucfirst($rows["mi"]);
				$course = ucfirst($rows["course"]);
				$partylist = ucfirst($rows["partylist"]);
				$position = $rows["position"];
				$candidateCouncilors .= '<tr>
  			  					<td class="candidate"><img class="img-can" src="images/'.$id_number.'.jpg" width="120" height="120" id="rotatepic"><h4 class="text-default">Name: <b>'.$firstname.' '.$mi.'. '.$lastname.'</b>&nbsp<span class="partylist">Course: <b>'.$course.'</b><span class="partylist">Partylist: <b>('.$partylist.')</b></h4></td>
     		  					<td class=" pull-right"><input class="radio-conc" type="checkbox" name="'.$position.'[]" value="'.$id_number.'"></td>
 								 </tr>';
			}
		}
	}

?>
