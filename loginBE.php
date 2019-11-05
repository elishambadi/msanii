<?php 
	session_start();
	require 'connect.php';

	$username = $_POST["username"]; //Could be a username or an email
	$password = md5($_POST["password"]);
	$userType = $_POST["userType"];

	if ($userType == "photographers") {
		$sql = "SELECT username, password FROM photographers WHERE (username = '$username')";
		$result = $conn -> query($sql);

		if ($result -> num_rows == 0) {
			echo "User does not exist in DB. Please check username";
		}
		else if ($result -> num_rows > 0) {
			while ($row = $result -> fetch_assoc()) {
				if ($row["password"] == $password) {
					echo "Login successful";
					$_SESSION["username"] = $row["username"];
					$_SESSION["userType"] = "photographers";
					header('Location: admin/dashboard.php');
					$_SESSION["logged"] == TRUE;
				}
			}
		}
	}

	if ($userType == "model") {
		$sql = "SELECT username, password, email FROM model WHERE (username = '$username')";
		$result = $conn -> query($sql);

		if ($result -> num_rows == 0) {
			echo "User does not exist in DB. Please check username";
		}
		else if ($result -> num_rows > 0) {
			while ($row = $result -> fetch_assoc()) {
				if ($row["password"] == $password) {
					echo "Login successful";
					$_SESSION["username"] = $row["username"];
					$_SESSION["userType"] = "model";
					header('Location: profile.php');
				}
			}
		}
	}

	if ($userType == "owner") {
		$sql = "SELECT email, password, username FROM owner WHERE (username = '$username')";
		$result = $conn -> query($sql);

		if ($result -> num_rows == 0) {
			echo "User does not exist in DB. Please check username";
		}
		else if ($result -> num_rows > 0) {
			while ($row = $result -> fetch_assoc()) {
				if ($row["password"] == $password) {
					echo "Login successful";
					$_SESSION["username"] = $row["username"];
					$_SESSION["userType"] = "owner";
					header('Location: profile.php');
				}
			}
		}
	}
 ?>