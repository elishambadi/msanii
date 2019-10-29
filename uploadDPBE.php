<?php 
	session_start();
	require("connect.php");

	print_r($_POST);
	//Upload file to server
	$target_dir = "profilePics/";
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

	//Collect other info to DB
	$image_name = basename($_FILES["image_upload"]["name"]);
	$username = $_SESSION["username"];
	echo $_SESSION["username"];

	//Final query to insert all into Database
	$sql = "INSERT INTO profileimages(image_name, username) VALUES ('$image_name', '$username')";

	if ($conn -> query($sql) === TRUE) {
		echo "Image uploaded successfully to DB";
		header('Location: profile.php');
	}
	else {
		echo "Error. Please try again.";
	}
 ?>