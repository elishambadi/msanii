<?php 
	require '../connect.php';
	$id = $_GET["id"];
	$table = $_GET["table"];

	switch ($table) {
		case 'photographers':
			$sql = "DELETE FROM photographers WHERE photographer_id = '$id'";
			break;

		case 'model':
			$sql = "DELETE FROM model WHERE model_id = '$id'";
			break;

		case 'location':
			$sql = "DELETE FROM location WHERE location_id = '$id'";
			break;
	}

	if ($conn -> query($sql) === TRUE) {
		echo "Successful deletion";
		$_SESSION["deleted"] = TRUE;
		header('Location: admin.php');
	}
	else{
		echo "Error: ".$conn->error;
	}
 ?>