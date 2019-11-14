<?php 
	session_start();
	if (isset($_GET["modelID"])) {
		unset($_SESSION["bookingModelID"]);
		header('Location: booking.php');
	}

	if (isset($_GET["photoID"])) {
		unset($_SESSION["bookingPhotoID"]);
		header('Location: booking.php');
	}

	if (isset($_GET["locID"])) {
		unset($_SESSION["bookingLocationID"]);
		header('Location: booking.php');
	}
 ?>