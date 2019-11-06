<?php 
	session_start();
	require 'connect.php';

	//Defining variables
	$bookingID = $_GET["id"];
	if (isset($_GET["disapproved"])) {
		$disapprove = "TRUE";
	}
	$_SESSION["bookingID"] = $bookingID;

	if ($_SESSION["userType"] == "photographers") {
		if ($disapprove != "TRUE") {
			$sql = "UPDATE bookings SET photographer_approve = \"YES\" WHERE booking_id = '$bookingID'";
			if ($conn -> query($sql) === TRUE) {
				header('Location: admin/dashboard.php');
			}
		}
		else{
			$sql = "UPDATE bookings SET photographer_approve = \"NO\" WHERE booking_id = '$bookingID'";
			if ($conn -> query($sql) === TRUE) {
				header('Location: admin/dashboard.php');
			}
		}
	}

	if ($_SESSION["userType"] == "model") {
		if ($disapprove != "TRUE") {
			$sql = "UPDATE bookings SET model_approve = \"YES\" WHERE booking_id = '$bookingID'";
			if ($conn -> query($sql) === TRUE) {
				header('Location: admin/dashboard.php');
			}
		}
		else{
			$sql = "UPDATE bookings SET model_approve = \"NO\" WHERE booking_id = '$bookingID'";
			if ($conn -> query($sql) === TRUE) {
				header('Location: admin/dashboard.php');
			}
		}
	}

	if ($_SESSION["userType"] == "owner") {
		if ($disapprove != "TRUE") {
			$sql = "UPDATE bookings SET location_approve = \"YES\" WHERE booking_id = '$bookingID'";
			if ($conn -> query($sql) === TRUE) {
				header('Location: admin/dashboard.php');
			}
		}
		else{
			$sql = "UPDATE bookings SET location_approve = \"NO\" WHERE booking_id = '$bookingID'";
			if ($conn -> query($sql) === TRUE) {
				header('Location: admin/dashboard.php');
			}
		}
	}
	
 ?>