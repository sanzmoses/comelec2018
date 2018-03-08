<?php include_once 'php.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="plugins/bootstrap.min.css">
	<script type="text/javascript" src="plugins/jquery.js"></script>
	<script type="text/javascript" src="master.js"></script>
</head>
<body style="background-color: #DDDDDD;">

<div class="container">
	<div class="row" style="margin-top: 100px;">
		<div class="col-md-2"></div>
		<div class="col-md-8 form-group" style="height: 400px;
		background-color: white; border-radius: 5px; padding: 30px 30px;">
		<form method="POST" action="list.php">
			<div class="input-group">
				<input id="search" class="form-control" name="name/ID"
			placeholder="Search Firstname or Lastname or ID" type="text"
			style="height: 50px;">
			<span class="input-group-addon">
			<button class="btn btn-default btn-block" type="submit" name="sub">
			Search</button>
			</span>
			</div>


			<div class="panel panel-default" style="margin-top: 25px">
				<div class="panel-body">
					<table class="table table-striped">
					<thead>
					<tr>
						<th>Name</th>
						<th>ID number</th>
						<th>Passcode</th>
						<th>Course</th>
						<th>Voted</th>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php foreach(getstudents() as $g): ?>
						<?php ($g->vote == 'yes')?	$color = '#bf0808': $color = 'black'; ?>
					<tr style="color: <?php echo $color ?>">
						<td>
						<?php echo $g->last_name.', '.$g->first_name; ?></td>
						<td><?php echo $g->ID_number; ?></td>
						<td><?php echo $g->passcode; ?></td>
						<td><?php echo $g->course; ?></td>
						<td><?php echo $g->vote; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				</div>
			</div>
		</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

</body>
</html>
