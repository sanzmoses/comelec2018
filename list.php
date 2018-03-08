<?php 

include 'php.php';
$db = connect();

if(isset($_POST['sub'])){
	echo $name = $_POST['name'];
	echo '<br>';
	echo $course = $_POST['course'];
	echo '<br>';
	echo $yr = $_POST['year'];

	$que = $db->prepare("INSERT INTO list
		SET name = :name, course = :course,
		yr = :yr ");

	$execute_query = [':name' => $name,
						':course' => $course,
						':yr' => $yr ];

	if($que->execute($execute_query)){
		echo 'success';
		header('Location: index.php?success');
	}
	else{
		echo 'error';
		header('Location: index.php?error');
	}
}

$que = $db->prepare("SELECT * FROM list");
$que->execute();
$results = $que->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table border="1">
	<tr>
		<th>Name</th>
		<th>Course</th>
		<th>Year</th>
	</tr>
	<?php foreach($results as $g): ?>
	<tr>
		<td><?php echo $g->name; ?></td>
		<td><?php echo $g->course; ?></td>
		<td><?php echo $g->yr; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
</body>
</html>

<style type="text/css">
	table tr th{
		font-weight: bold;
		padding: 5px 20px 5px 20px;
	}
	tr td{
		padding-top: 5px;
		padding-left: 10px;
		padding-right: 10px;
		padding-bottom: 5px;
	}

</style>