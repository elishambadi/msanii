<?php 
  session_start();
  if (!isset($_SESSION["username"])) {
    $_SESSION["logged"] = FALSE;
    header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Msanii - Book</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <!-- Fontawesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    .row {
      display: flex;
      flex-wrap: wrap;
      padding: 0 4px;
    }

    /* Create two equal columns that sits next to each other */
    .column {
      flex: 50%;
      padding: 0 4px;
    }

    .column img {
      margin-top: 8px;
      vertical-align: middle;
    } 
    table{
      border: 2px solid black;
      margin-left: auto;
      margin-right: auto;
      font-size: 25px;
    }
    th, td{
      border: 1px solid black;
    }
  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading" style="font-size: 42px">
        <i class="fa fa-camera-retro" style="font-size: 32px"></i>&nbsp;Msanii
      </div>
      <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="admin/dashboard.php" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="booking.php" class="list-group-item list-group-item-action bg-light">Bookings</a>
        <a href="uploadPhoto.php" class="list-group-item list-group-item-action bg-light">Upload photo</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="profile.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Support</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Search
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="search.php">Models</a>
                <a class="dropdown-item" href="search.php">Photographers</a>
                <a class="dropdown-item" href="search.php">Locations</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <?php if (!isset($_GET["id"])): ?>
        <h4 style="text-align: center;">New Booking</h4>
        <div class="row" style="margin-top: 20px">
        <div class="col-md-4">
          <button onclick="window.location.href = 'viewBookings.php'" class="btn btn-info">View All Bookings</button><br><br>

          <form action="newBook.php" method="POST" enctype="multipart/form-data">
            <label>Booking Location: </label>
            <input type="text" name="location"><br>
            <label>Models: </label>
            <input type="text" name="model"><br>
            <label>Photographers: </label>
            <input type="text" name="photographer"><br>
            <label>Dates: </label>
            <input type="date" name="bookingDate"><br>
            <label>Start Time: </label>
            <input type="Time" name="startTime"><br>
            <label>End Time: </label>
            <input type="Time" name="endTime"><br>
            <label>Description: </label>
            <input type="text" name="description" height="10"><br>
            <input type="submit" name="submit" value="SUBMIT BOOKING">

          </form>
        </div>
        <div class="col-md-4">
          <img id="outputImage" width="600px" height="400px">
        </div>
      </div>
      <?php else: ?>
        <h4 style="text-align: center;">Booking Details</h4><br>
        <?php 
          $bookID = $_GET["id"];
          require 'connect.php';
          $sql = "SELECT * FROM bookings WHERE booking_id = '$bookID'";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>"."<th>Booking No. </th><td>".$row["booking_id"]."</td><tr>";
              echo "<tr>"."<th>Client username: </th><td>".$row["client_name"]."</td><tr>";
              echo "<tr>"."<th>Date: </th><td>".$row["booking_date"]."</td><tr>";
              echo "<tr>"."<th>Start Time: </th><td>".$row["start_time"]."</td><tr>";
              echo "<tr>"."<th>End Time: </th><td>".$row["end_time"]."</td><tr>";
              echo "<tr>"."<th>Location: </th><td>";

              //Getting location name
              $sql = "SELECT location_name FROM location WHERE location_id = ".$row["location_id"];
              $result1 = $conn -> query($sql);
              if ($result1 -> num_rows > 0) {
                while ($row = $result1 -> fetch_assoc()) {
                  echo $row["location_name"];
                }
              }
              //Close getting location name
              echo "</td><tr>";
              echo "</table><br>";
              if (!isset($_GET["approved"])) {
                echo "<a class = \"btn btn-success\" href=\"approve.php?id=".$bookID."\">Approve?</a><br><br>";
                echo "<a class = \"btn btn-danger\" href=\"approve.php?id=".$bookID."&&disapproved=true\">Disapprove?</a><br>";
              }
              elseif ($_GET["approved"] == FALSE) {
                echo "<a style=\"color:white\" class=\"btn btn-danger\">Disapproved!</a>";
              }
              else{
                echo "<a style=\"color:white\" class=\"btn btn-success\">Approved!</a>";
              }
            }
          }
         ?>
      <?php endif ?>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

  <!-- <script type='text/javascript'>
    function preview_image(event) 
    {
     var reader = new FileReader();
     reader.onload = function()
     {
      var output = document.getElementById('outputImage');
      output.src = reader.result;
     }
     reader.readAsDataURL(event.target.files[0]);
    }
    </script> -->


</body>

</html>
