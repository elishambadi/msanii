<?php 
	print_r($_POST);
	//Upload file to server
	$target_dir = "uploads/";
	$target_file = $target_dir.basename($_FILES["image_upload"]["name"]);
	$uploadOK = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image_upload"]["tmp_name"]);
		if ($check !== false) {
			echo "File is an image".$check["mime"].".";
			$uploadOK = 1;
		}
		else{
			echo "File is not an image";
			$uploadOK = 0;
		}
	}

	if ($uploadOK == 0) {
		echo "Sorry, your file was not uploaded";
	}
	else{
		if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
			echo "The file".$_FILES["image_upload"]["name"]." has been uploaded";
		}
		else{
			echo "Sorry, there was an error uploading your file.";
		}
	}
	//End upload file to server

	//Collect other info to DB
	$image_name = basename($_FILES["image_upload"]["name"]);
	$photographer = $_POST["pName"];
	$location = $_POST["location"];
	$model = $_POST["mName"];
	$caption = $_POST["caption"];

	require("connect.php");

	//Get photographerID - Done
	$sql = "SELECT photographer_id FROM photographers WHERE (username = '$photographer')";
	$result = $conn -> query($sql);

	if ($result -> num_rows == 1) {
		while ($row = $result -> fetch_assoc()) {
			$photographer_id = $row["photographer_id"];
		}
	}

	//Get ModelID
	$sql = "SELECT model_id FROM model WHERE (username = '$model')";
	$result = $conn -> query($sql);

	if ($result -> num_rows == 1) {
		while ($row = $result -> fetch_assoc()) {
			$model_id = $row["model_id"];
		}
	}

	//Get locationID
	$sql = "SELECT location_id FROM location WHERE (location_name = '$location')";
	$result = $conn -> query($sql);

	if ($result -> num_rows == 1) {
		while ($row = $result -> fetch_assoc()) {
			$location_id = $row["location_id"];
		}
	}

	//Final query to insert all into Database
	$sql = "INSERT INTO images (image_name, location_id, photographer_id, model_id, caption)
	VALUES ('$image_name','$location_id','$photographer_id','$model_id','$caption')";

	if ($conn -> query($sql) === TRUE) {
		echo "Image uploaded successfully to DB";
		header('Location: profile.php');
	}
	else {
		echo "Error. Please try again.";
	}
 ?>