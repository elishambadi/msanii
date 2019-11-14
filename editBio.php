<?php 
	session_start();
	$table = $_SESSION["userType"];
	$bio = $_POST["bio"];
  echo $bio."<br>";
  echo $table."<br>";

  $bio = "<pre>".$bio."</pre>";

	require 'connect.php';

 	if ($table == "photographers") {
    	$sql = "UPDATE photographers SET bio = '$bio' WHERE username ='".$_SESSION["username"]."'";
    	if ($conn -> query($sql) == TRUE) {
        echo $bio;
        echo "Successful editing!";
    		// header('Location: profile.php');
    	}
    	else{
    		echo "Error changing bio ".$conn->error;
    	}
  	}
?>