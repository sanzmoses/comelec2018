<?php

$con = mysqli_connect("localhost","root","","testing") or die ("error" . mysqli_error());
$message = "";
if(isset($_POST["submit"])){
	if(isset($_FILES['file'])){
		
	$name_array = $_FILES['file']['name'];
	$tmp_name_array = $_FILES['file']['tmp_name'];
	$type = $_FILES['file']['type'];
	$error = $_FILES['file']['error'];
		for($i = 0; $i < count($tmp_name_array); $i++){
		$check = pathinfo($name_array[$i], PATHINFO_EXTENSION);
		
		if($check != "csv"){
			echo "csv lng chuy";
		}else {
			$handle = fopen($tmp_name_array[$i],"r");	
			do {
				if(isset($data[0])){
					 $test = mysqli_query($con,"INSERT INTO testing (test1, test12, test3, test4) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."'  
                ) 
            "); 
				}else {
					$message = "done";				}
			}while ($data = fgetcsv($handle,1000,",","'"));
				
			if($test[$i]){
				
			}
		}

		}
	
		
	}else {
		echo "select sa chuy!";
	}
}




	
?>

<!DOCTYPE html>
<html>
<script src="js/jquery-1.11.2.js"></script>	
<body>

<?php if (!empty($_GET["success"])) { echo "<b>Your file has been imported.</b><br><br>"; } ?>
	<form method="post" action="upload.php" name="import" enctype="multipart/form-data" onsubmit="return validation();">
		<p>upload</p>
		<?php echo $message; ?>
		<input type="file" name="file[]">
		<input type="file" name="file[]">
		<input type="submit" name="submit" value="submit">

	</form>
</body>
<script>
function validation(){
	for(var i =0; i < 2; i++){
		if(document.forms["import"]["file[]"].value == ''){
		alert("uploadsad!");
		return false;
	}

	}
	

} 
</script>
</html>