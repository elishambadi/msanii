<?php 
	session_start();
	require '../connect.php';

	$email = $_POST["email"]; //Could be a username or an email
	$password = md5($_POST["password"]);

	$sql = "SELECT email, password FROM clients WHERE email = '$email'";
	$result = $conn -> query($sql);

	if ($result -> num_rows == 0) {
		echo "User does not exist in DB. Please check username";
	}
	else if ($result -> num_rows > 0) {
		while ($row = $result -> fetch_assoc()) {
			if ($row["password"] == $password) {
				echo "Login successful";
				$_SESSION["username"] = $row["email"];
				$_SESSION["userType"] = "client";
				header('Location: ../search.php');
				$_SESSION["logged"] == TRUE;
			}
			else{
				$_SESSION["password"] = "false";
				header('Location: login.php');
			}
		}
	}
 ?>