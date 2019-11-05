<?php 
  session_start();
  if (!isset($_SESSION["username"])) {
    $_SESSION["logged"] = FALSE;
    header('Location: ../login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Msanii - After Book</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/simple-sidebar.css" rel="stylesheet">

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
        <a href="../profile.php" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="../booking.php" class="list-group-item list-group-item-action bg-light">Bookings</a>
        <a href="../uploadPhoto.php" class="list-group-item list-group-item-action bg-light">Upload photo</a>
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
        <h4 style="text-align: center;"></h4>
        <div class="row" style="margin-top: 20px">
          <div class="col-md-12">
            <h3>All bookings for <?php echo $_SESSION["username"]; ?></h3>
            <?php 
              require '../connect.php';
              $username = $_SESSION["username"];
              if (isset($_SESSION["userType"])) {
                $userType = $_SESSION["userType"];
              }
              else{
                $userType = "";
              }
              
              //Photographer Dashboard start
              //Get photographer_id
              $sql = "SELECT photographer_id FROM photographers WHERE (username = '$username')";
              $result = $conn -> query($sql);

              if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                  $photographer_id = $row["photographer_id"];
                }
              };
              //Get owner ID closed
              if ($userType == "photographers") {
                $sql="SELECT booking_date, start_time, end_time, client_name, booking_id, location_approve, description FROM bookings WHERE photographer_id = '$photographer_id'";

                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {  
                  echo "<table>";
                  echo "<tr>";
                  echo "<th>id</th>";
                  echo "<th>Client username</th>";
                  echo "<th>Date</th>";
                  echo "<th>Description</th>";
                  echo "<th></th>"; //Display status
                  echo "<th></th>"; //Display view button
                  echo "</tr>";
                  $counter = 1;
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$counter."</td>";
                    echo "<td>".$row["client_name"]."</td>";
                    echo "<td>".$row["booking_date"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    if ($row["location_approve"] == "") {
                      echo "<td><a class=\"btn btn-warning\">Pending</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    elseif ($row["location_approve"] == "YES") {
                      echo "<td><a class=\"btn btn-success\">Approved</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?approved=true&&id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    elseif (($row["location_approve"] == "NO")) {
                      echo "<td><a class=\"btn btn-success\">Disapproved</a></td>";
                      echo "<td>"."<a class=\"btn btn-danger\" href=\"../booking.php?disapproved=true&&id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    echo "</tr>";
                    $counter++;
                  }
                  echo "</table>";
                }
              }
              //End model dashboard

              //Model Dashboard start
              //Get model_id
              $sql = "SELECT model_id FROM model WHERE (username = '$username')";
              $result = $conn -> query($sql);

              if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                  $model_id = $row["model_id"];
                }
              };
              //Get owner ID closed
              if ($userType == "model") {
                $sql="SELECT booking_date, start_time, end_time, client_name, booking_id, location_approve, description FROM bookings WHERE model_id = '$model_id'";

                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {  
                  echo "<table>";
                  echo "<tr>";
                  echo "<th>id</th>";
                  echo "<th>Client username</th>";
                  echo "<th>Date</th>";
                  echo "<th>Description</th>";
                  echo "<th></th>"; //Display status
                  echo "<th></th>"; //Display view button
                  echo "</tr>";
                  $counter = 1;
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$counter."</td>";
                    echo "<td>".$row["client_name"]."</td>";
                    echo "<td>".$row["booking_date"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    if ($row["location_approve"] == "") {
                      echo "<td><a class=\"btn btn-warning\">Pending</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    elseif ($row["location_approve"] == "YES") {
                      echo "<td><a class=\"btn btn-success\">Approved</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?approved=true&&id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    elseif (($row["location_approve"] == "NO")) {
                      echo "<td><a class=\"btn btn-danger\">Disapproved</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?disapproved=true&&id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    echo "</tr>";
                    $counter++;
                  }
                  echo "</table>";
                }
              }
              //End model dashboard

              //Locations Dashboard start
              if ($userType == "owner") {
              //Start Get owner_id
              $sql = "SELECT owner_id FROM owner WHERE (username = '$username')";
              $result = $conn -> query($sql);

              if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                  $owner_id = $row["owner_id"];
                }
              };
              //Close Get owner_id
              //Get owner_id
              $sql = "SELECT location_id FROM location WHERE (owner_id = '$owner_id')";
              $result = $conn -> query($sql);

              if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                  $location_id = $row["location_id"];
                  echo $location_id;
                }
              };
              //Get owner ID closed
              
                $sql="SELECT * FROM bookings WHERE location_id = '$location_id'";

                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {  
                  echo "<table>";
                  echo "<tr>";
                  echo "<th>id</th>";
                  echo "<th>Client username</th>";
                  echo "<th>Date</th>";
                  echo "<th>Description</th>";
                  echo "<th></th>"; //Display status
                  echo "<th></th>"; //Display view button
                  echo "</tr>";
                  $counter = 1;
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$counter."</td>";
                    echo "<td>".$row["client_name"]."</td>";
                    echo "<td>".$row["booking_date"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    if ($row["location_approve"] == "") {
                      echo "<td><a class=\"btn btn-warning\">Pending</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    elseif ($row["location_approve"] == "YES") {
                      echo "<td><a class=\"btn btn-success\">Approved</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?approved=true&&id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    elseif (($row["location_approve"] == "NO")) {
                      echo "<td><a class=\"btn btn-danger\">Disapproved</a></td>";
                      echo "<td>"."<a class=\"btn btn-info\" href=\"../booking.php?disapproved=true&&id=".$row["booking_id"]."\">View</a>"."</td>";
                    }
                    echo "</tr>";
                    $counter++;
                  }
                  echo "</table>";
                }
              }
              //End locations dashboard

              //Normal clients dashboard
              if (isset($_SESSION["client_email"])) {
                $client_email = $_SESSION["client_email"];
                $sql="SELECT * FROM bookings WHERE client_name = '$client_email'";

                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {  
                  echo "<table>";
                  echo "<tr>";
                  echo "<th>id</th>";
                  echo "<th>Client</th>";
                  echo "<th>Date</th>";
                  echo "<th>Description</th>";
                  echo "<th>Location</th>"; //Display status
                  echo "<th>Photographer</th>"; //Display view button
                  echo "<th>Model</th>"; //Display view button
                  echo "</tr>";
                  $counter = 1;
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$counter."</td>";
                    echo "<td>".$row["client_name"]."</td>";
                    echo "<td>".$row["booking_date"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    //Display location approvals
                    if ($row["location_approve"] == "") {
                      echo "<td><a class=\"btn btn-warning\">Pending</a></td>";
                    }
                    elseif ($row["location_approve"] == "YES") {
                      echo "<td><a class=\"btn btn-success\">Approved</a></td>";
                    }
                    elseif (($row["location_approve"] == "NO")) {
                      echo "<td><a class=\"btn btn-danger\">Disapproved</a></td>";
                    }
                    //End display location approvals

                    //Display photographer approvals
                    if ($row["photographer_approve"] == "") {
                      echo "<td><a class=\"btn btn-warning\">Pending</a></td>";
                    }
                    elseif ($row["photographer_approve"] == "YES") {
                      echo "<td><a class=\"btn btn-success\">Approved</a></td>";
                    }
                    elseif (($row["photographer_approve"] == "NO")) {
                      echo "<td><a class=\"btn btn-danger\">Disapproved</a></td>";
                    }
                    //End display photographer approvals

                    //Display photographer approvals
                    if ($row["model_approve"] == "") {
                      echo "<td><a class=\"btn btn-warning\">Pending</a></td>";
                    }
                    elseif ($row["model_approve"] == "YES") {
                      echo "<td><a class=\"btn btn-success\">Approved</a></td>";
                    }
                    elseif (($row["model_approve"] == "NO")) {
                      echo "<td><a class=\"btn btn-danger\">Disapproved</a></td>";
                    }
                    //End display photographer approvals

                    echo "</tr>";
                    $counter++;
                  }
                  echo "</table>";
                }
              }
              //End of normal clients dashboard
             ?>
          </div>
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
