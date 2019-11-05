<?php 
	session_start();
	print_r($_POST);
	echo "<br><br>";

	require 'connect.php';
	if (isset($_POST["client_email"])) {
		$client_email = $_POST["client_email"];
	}
	if (isset($_POST["photographer"])) {
		$photographer = $_POST["photographer"];
		//Get photographerID
		$sql = "SELECT photographer_id FROM photographers WHERE (username = '$photographer')";
		$result = $conn -> query($sql);

		if ($result -> num_rows == 1) {
			while ($row = $result -> fetch_assoc()) {
				$photographer_id = $row["photographer_id"];
			}
		}
	}
	else{
		$photographer_id = "";	
	}

	if (isset($_POST["model"])) {
		$model = $_POST["model"];
		//Get ModelID
		$sql = "SELECT model_id FROM model WHERE (username = '$model')";
		$result = $conn -> query($sql);

		if ($result -> num_rows == 1) {
			while ($row = $result -> fetch_assoc()) {
				$model_id = $row["model_id"];
			}
		}
	}
	else{
		$model_id = "";
	}

	if (isset($_POST["location"])) {
		$location = $_POST["location"];
		//Get locationID
		$sql = "SELECT location_id FROM location WHERE (location_name = '$location')";
		$result = $conn -> query($sql);

		if ($result -> num_rows == 1) {
			while ($row = $result -> fetch_assoc()) {
				$location_id = $row["location_id"];
			}
		}
	}
	else{
		$location_id = "";
	}

	$start_time = $_POST["startTime"];
	$end_time = $_POST["endTime"];
	$booking_date = $_POST["bookingDate"];
	$description = $_POST["description"];
	$client_name = $_SESSION["username"];
	echo $client_email;

	//Finally insert into Database
	if (isset($client_email)) {
		$sql = "INSERT INTO bookings(booking_date, start_time, end_time, client_name, location_id, photographer_id, model_id, description)
	VALUES ('$booking_date', '$start_time', '$end_time', '$client_email', '$location_id', '$photographer_id', '4', '$description')";
	}
	else{
		$sql = "INSERT INTO bookings(booking_date, start_time, end_time, client_name, location_id, photographer_id, model_id, description)
		VALUES ('$booking_date', '$start_time', '$end_time', '$client_name', '$location_id', '$photographer_id', '$model_id', '$description')";
	}

	if ($conn -> query($sql) === TRUE) {
		echo "Booking Successful";
		header('Location: admin/dashboard.php');
		$_SESSION["client_email"] = $client_email;
	}
	else{
		echo "Error in booking: ".$conn -> error;
	}
 ?>