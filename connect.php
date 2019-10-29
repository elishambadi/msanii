<?php 
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "msanii";

	$conn = new mysqli($server, $username, $password, $database) 
	or die("Connection failed: \n".$conn -> error);
 ?>