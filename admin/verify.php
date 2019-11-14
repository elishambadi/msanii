<?php 
	$photoID = $_GET["id"];
	$table = $_GET["table"];
	require '../connect.php';

	switch ($table) {
		case 'photographers':
			$sql = "UPDATE photographers SET verified = 'YES' WHERE photographer_id = '$photoID'"; 
			break;

		case 'model':
			$sql = "UPDATE model SET verified = 'YES' WHERE model_id = '$photoID'"; 
			break;

		case 'location':
			$sql = "UPDATE location SET verified = 'YES' WHERE location_id = '$photoID'"; 
			break;
	}

	if ($conn -> query($sql) === TRUE) {
		echo "Verification successful!";
		require '../sendEmail.php';
		
		$_SESSION["verified"] = TRUE;
		header('Location: admin.php');
	}
	else{
		echo "Error: ".$conn->error;
	}
 ?>