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
        <a href="events.php" class="list-group-item list-group-item-action bg-light">Events</a>
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
            <li class="nav-item">
              <a class="nav-link" href="search.php">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <?php if (!isset($_GET["id"])): ?>
        <div class="row" style="margin-top: 20px">
        <div class="col-md-10">
          <h4 style="text-align: center;">New Booking</h4>

          <form action="newBook.php" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-6">
            
            <?php 
            // Location definition
              if (!isset ($_SESSION["bookingLocationID"]) && isset($_GET["locID"])) {
                $_SESSION["bookingLocationID"] = $_GET["locID"];
              }   
              if (isset($_SESSION["bookingLocationID"])) {
                require 'connect.php';
                $locID = $_SESSION["bookingLocationID"];
                $sql = "SELECT location_name, location_id FROM location WHERE location_id = '$locID'";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    echo "<input type=\"hidden\" name=\"location\" class=\"form-control\" value=".$row["location_name"].">";
                    echo "<label>Booking Location: </label> <b>".$row["location_name"]."&nbsp;&nbsp;</b>";
                    echo "<a href=\"remove.php?locID=".$row["location_id"]."\" class=\"btn btn-info\">Remove</a><br><br>";
                  }
                }
              }
              else{
                echo "<label>Booking Location:&nbsp;&nbsp;</label><a href=\"search.php\" class=\"btn-info btn\">Add Location</a><br><br>";
              }
             ?>

            <!-- Models definition -->
            <?php 
              if (!isset($_SESSION["bookingModelID"]) && isset($_GET["modelID"])) {
                $_SESSION["bookingModelID"] = $_GET["modelID"];
              }
              if (isset($_SESSION["bookingModelID"])) {
                require 'connect.php';
                $modelID = $_SESSION["bookingModelID"];
                $sql = "SELECT username, model_id FROM model WHERE model_id = '$modelID'";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    echo "<input type=\"hidden\" name=\"model\" class=\"form-control\" value=".$row["username"].">";
                    echo "<label>Model: </label> <b>".$row["username"]."&nbsp;&nbsp;</b>";
                    echo "<a href=\"remove.php?modelID=".$row["model_id"]."\" class=\"btn btn-info\">Remove</a><br><br>";
                  }
                }
              }
              else{
                echo "<label>Model: &nbsp;&nbsp;</label><a href=\"search.php\" class=\"btn-info btn\">Add Model</a><br><br>";
              }
             ?>

            <!-- Photographer definition -->
            <?php 
              if (!isset($_SESSION["bookingPhotoID"]) && isset($_GET["photoID"])) {
                $_SESSION["bookingPhotoID"] = $_GET["photoID"];
              }
              if (isset($_SESSION["bookingPhotoID"])) {
                require 'connect.php';
                $photographer_id = $_SESSION["bookingPhotoID"];
                $sql = "SELECT username, photographer_id FROM photographers WHERE photographer_id = '$photographer_id'";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    echo "<input type=\"hidden\" name=\"photographer\" class=\"form-control\" value=".$row["username"].">";
                    echo "<label>Photographer: </label> <b>".$row["username"]."&nbsp;&nbsp;</b>";
                    echo "<a href=\"remove.php?photoID=".$row["photographer_id"]."\" class=\"btn btn-info\">Remove</a><br><br>";
                  }
                }
              }
              else{
                echo "<label>Photographer: &nbsp;&nbsp;</label><a href=\"search.php\" class=\"btn-info btn\">Add Photographer</a><br><br>";
              }
             ?>
            <!-- <label>Dates: </label> -->
            <input type="date" name="bookingDate"  class="form-control" placeholder="Date of booking"><br>
            <!-- <label>Description: </label> -->
            <input type="text" name="description"  class="form-control" placeholder="Description"><br><br>
            </div>
            <div class="col-md-6">
            <label>Start Time: </label>
            <input type="Time" name="startTime"  class="form-control" placeholder="Start time"><br>
            <label>End Time: </label>
            <input type="Time" name="endTime"  class="form-control" placeholder="End time"><br>

            <!-- Client email for the form -->
            <!-- <label>Enter contact email: </label> -->
            <input type="email" name="client_email" height="10" class="form-control" required="required" placeholder="Client email"><br>
            </div>
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT BOOKING">

          </form>
        </div>
        <div class="col-md-4">
          <img id="outputImage" width="600px" height="400px">
        </div>
      </div>
      <?php else: ?>
        <!-- Display updates from the dashboard.php page -->
        <h4 style="text-align: center;">Booking Details</h4><br>
        <?php 
          $bookID = $_GET["id"];
          require 'connect.php';
          $sql = "SELECT * FROM bookings WHERE booking_id = '$bookID'";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table class=\"table table-hover\">";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>"."<th>Booking No. </th><td>".$row["booking_id"]."</td><tr>";
              echo "<tr>"."<th>Client username: </th><td>".$row["client_name"]."</td><tr>";
              echo "<tr>"."<th>Date: </th><td>".$row["booking_date"]."</td><tr>";
              echo "<tr>"."<th>Start Time: </th><td>".$row["start_time"]."</td><tr>";
              echo "<tr>"."<th>End Time: </th><td>".$row["end_time"]."</td><tr>";
              echo "<tr>"."<th>Description: </th><td>".$row["description"]."</td><tr>";
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
              if (!isset($_GET["approved"]))
               {
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
