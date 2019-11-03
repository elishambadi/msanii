<?php 
	session_start();
  	$username = $_SESSION["username"];
  	$table = $_SESSION["userType"];
  	echo $username;
  	$bio = $_POST["bio"];
  	echo $bio;

  	require 'connect.php';

 	if ($table == "photographers") {
    	$sql = "UPDATE photographers SET bio = '$bio' WHERE username = '$username'";
    	if ($conn -> query($sql) == TRUE) {
    		header('Location: profile.php');
    	}
    	else{
    		echo "Error changing bio".$conn->error;
    	}
  	}
?>