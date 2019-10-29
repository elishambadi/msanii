<?php 
	require 'connect.php';

	$id = $_GET["id"];

	$sql = "DELETE FROM images WHERE image_id = '$id'";
	if ($conn -> query($sql)) {
		echo "Image deleted successfully";
		header('Location: profile.php');
	}
	else{
		echo "Error: ".$conn-> error;
	}
 ?>