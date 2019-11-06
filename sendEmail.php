<?php 
	session_start();
	require 'connect.php';
	$bookingID = $_SESSION["bookingID"];

	function verifyEmail($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Email is invalid";
			break;
		}
	}
	function sendApprovalEmail($email){
		verifyEmail($email);
		$sql = "SELECT * FROM bookings WHERE booking_id = '$bookingID'";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0) {
			while ($row = $result -> fetch_assoc()) {
				$msg="Your booking has been approved. Kindly confirm the details.\n".
				"Booking Date: ".$row["booking_date"].
				"\nPhotographer: ".
					//Get photographer Name
					$sql = "SELECT username FROM photographers WHERE photographer_id = ".$row["photographer_id"];
					$result1 = $conn -> query($sql);
					if ($result1 -> num_rows > 0) {
						while ($row1 = $result1 -> fetch_assoc()) {
							echo $row1["username"];
						}
					}
				."\nModel: ".
					//Get model Name
					$sql = "SELECT username FROM model WHERE model_id = ".$row["model_id"];
					$result1 = $conn -> query($sql);
					if ($result1 -> num_rows > 0) {
						while ($row1 = $result1 -> fetch_assoc()) {
							echo $row1["username"];
						}
					}
				."\nLocation: ".
					//Get model Name
					$sql = "SELECT location_name FROM locations WHERE location_id = ".$row["location_id"];
					$result1 = $conn -> query($sql);
					if ($result1 -> num_rows > 0) {
						while ($row1 = $result1 -> fetch_assoc()) {
							echo $row1["location_name"];
						}
					}
				."\nStart Time: ".$row["start_time"]
				."\nEnd Time: ".$row["end_time"];

				$msg = wordwrap($msg, 70);
				mail($email, "Msanii: Booking Approved", $msg);

			}
		}

	}
	function sendDisapprovalEmail($email){
		verifyEmail($email);
		$msg="Your booking has been disapproved. Kindly contact support";
		$msg = wordwrap($msg, 70);
		mail($email, "Msanii: Booking Disapproved", $msg);
	}
 ?>