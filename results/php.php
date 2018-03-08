<?php 

function connect(){
	$db = new PDO("mysql:host=localhost;dbname=voting","root","");
	return $db;
}

if(isset($_GET['results'])){
	$db = connect();

	$eng = $db->prepare("SELECT COUNT(*) 'ENG' FROM `students` WHERE vote = 'yes' AND 
		course IN ('BSCPE','BSGE','BSECE')");
	$eng->execute();
	$results['eng'] = $eng->fetchAll(PDO::FETCH_OBJ);

	$it = $db->prepare("SELECT COUNT(*) 'ENG' FROM `students` WHERE vote = 'yes' 
		AND course IN ('BSIT', 'BSCS')");
	$it->execute();
	$results['it'] = $it->fetchAll(PDO::FETCH_OBJ);

	$nurse = $db->prepare("SELECT COUNT(*) 'ENG' FROM `students` WHERE vote = 'yes' 
		AND course IN ('BSN')");
	$nurse->execute();
	$results['nurse'] = $nurse->fetchAll(PDO::FETCH_OBJ);

	$educ = $db->prepare("SELECT COUNT(*) 'ENG' FROM `students` WHERE vote = 'yes' 
		AND course IN ('BEED','BEEDSPED','BSEDE', 'BSEDM', 'BSEDMAPH')");
	$educ->execute();
	$results['educ'] = $educ->fetchAll(PDO::FETCH_OBJ);

	$hrm = $db->prepare("SELECT COUNT(*) 'ENG' FROM `students` WHERE vote = 'yes' 
		AND course IN ('BSHRM','BSTM')");
	$hrm->execute();
	$results['hrm'] = $hrm->fetchAll(PDO::FETCH_OBJ);

	$crim = $db->prepare("SELECT COUNT(*) 'ENG' FROM `students` WHERE vote = 'yes' 
		AND course IN ('BSCR')");
	$crim->execute();
	$results['crim'] = $crim->fetchAll(PDO::FETCH_OBJ);

	return $results;
}

 ?>