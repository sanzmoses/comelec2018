<?php

function connect(){
	$db = new PDO("mysql:host=localhost;dbname=voting","root","");
	return $db;
}

function getstudents(){
	$db = connect();
	$query = $db->prepare("SELECT * FROM students LIMIT 5");
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function searchstudents($name){
	$db = connect();
	$names = "";
	$names.= '%';
	$names.= $name;
	$names.= '%';
	$query = $db->prepare("SELECT * FROM
		students WHERE last_name LIKE ? OR
		first_name LIKE ? OR
		ID_number LIKE ? LIMIT 5");
	$query->bindParam(1,$names);
	$query->bindParam(2,$names);
	$query->bindParam(3,$names);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

if(isset($_POST['search'])){
	$result = searchstudents($_POST['search']);
	$html = '';
	$color = '';
	foreach ($result as $r) {
		($r->vote == 'yes')?	$color = '#bf0808': $color = 'black';
		$html .= '<tr style="color: '.$color.'">
						<td><input hidden name="name" value="'.$r->first_name.' '.$r->last_name.'">'.$r->last_name.', '.$r->first_name.'</td>
						<td><input hidden name="course" value="'.$r->course.'">'.$r->ID_number.'</td>
						<td><input hidden name="year" value="'.$r->year.'">'.$r->passcode.'</td>
						<td>'.$r->course.'</td>
						<td>'.$r->vote.'</td>
					</tr>';
	}
	echo $html;
}

if(isset($_POST['show'])){
	$result = getstudents();
	$html = '';
	foreach ($result as $r) {
		$html .= '<tr>
						<td>'.$r->last_name.', '.$r->first_name.'</td>
						<td>'.$r->ID_number.'</td>
						<td>'.$r->passcode.'</td>
						<td>'.$r->course.'</td>
						<td>'.$r->vote.'</td>
					</tr>';
	}
	echo $html;
}

 ?>
