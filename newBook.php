<?php 
	require 'connect.php';
	$photographer = $_POST["photographer"];
	$model = $_POST["model"];
	$location = $_POST["location"];
	$start_time = $_POST["startTime"];
	$end_time = $_POST["endTime"];
	$booking_date = $_POST["bookingDate"];
	$description = $_POST["description"];

	//Get photographer name
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

	//Finally insert into Database
	$sql = "INSERT INTO bookings(booking_date, start_time, end_time, location_id, photographer_id, model_id, description)
	VALUES ('$booking_date', '$start_time', '$end_time', '$location_id', '$photographer_id', '$model_id', '$description')";

	if ($conn -> query($sql) === TRUE) {
		echo "Booking Successful";
		header('Location: viewBookings.php');
	}
	else{
		echo "Error in booking".$conn -> error;
	}
 ?>