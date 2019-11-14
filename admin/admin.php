<?php 
session_start();
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
        <a href="admin.php?id=1" class="list-group-item list-group-item-action bg-light">Photographers</a>
        <a href="admin.php?id=2" class="list-group-item list-group-item-action bg-light">Models</a>
        <a href="admin.php?id=3" class="list-group-item list-group-item-action bg-light">Locations</a>
        <a href="admin.php?id=4" class="list-group-item list-group-item-action bg-light">Bookings</a>
        <!-- <a href="" class="list-group-item list-group-item-action bg-light"></a> -->
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
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <?php if(isset($_GET["id"])) {

          switch ($_GET["id"]) {
            case '1':
              echo "<h4 style=\"text-align: center;\">Photographers</h4>";
              break;

            case '2':
              echo "<h4 style=\"text-align: center;\">Models</h4>";
              break;

            case '3':
              echo "<h4 style=\"text-align: center;\">Locations</h4>";
              break;

            case '4':
              echo "<h4 style=\"text-align: center;\">Bookings</h4>";
              break;
            
            default:
              echo "<h4 style=\"text-align: center;\">Admin</h4>";
              break;
          }
        } 
        else{
          echo "<h4 style=\"text-align: center;\">Admin</h4>";
        }
        ?>
        
        <div class="row" style="margin-top: 20px">
          <div class="col-md-12">
            <?php 
              require '../connect.php';
              //Photographers
              if (isset($_GET["id"]) && $_GET["id"] == 1) {
                $sql = "SELECT * FROM photographers";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  echo "<table class=\"table\">";
                  echo "<tr>";
                  echo "<th>ID</th>";
                  echo "<th>Username</th>";
                  echo "<th>First Name</th>";
                  echo "<th>Last Name</th>";
                  echo "<th>Expertise</th>";
                  echo "<th>Verified</th>";
                  echo "<th></th>";
                  echo "</tr>";
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["photographer_id"]."</td>";
                    echo "<td>".$row["username"]."</td>";
                    echo "<td>".$row["first_name"]."</td>";
                    echo "<td>".$row["last_name"]."</td>";
                    echo "<td>".$row["expertise"]."</td>";
                    echo "<td>".$row["verified"]."</td>";
                    echo "<td><a class=\"btn btn-success\" href=\"verify.php?table=photographers&&id=".$row["photographer_id"]."\">Verify</a></td>";
                    // echo "<td><a class=\"btn btn-danger\" href=\"delete.php?table=photographers&&id=".$row["photographer_id"]."\">Delete</a></td>";
                    echo "</tr>";
                  }
                  echo "<table>";
                }
              }
              //Models
              elseif (isset($_GET["id"]) && $_GET["id"] == 2) {
                $sql = "SELECT * FROM model";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  echo "<table class=\"table\">";
                  echo "<tr>";
                  echo "<th>ID</th>";
                  echo "<th>Username</th>";
                  echo "<th>First Name</th>";
                  echo "<th>Last Name</th>";
                  echo "<th>Verified</th>";
                  echo "<th></th>";
                  echo "</tr>";
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["model_id"]."</td>";
                    echo "<td>".$row["username"]."</td>";
                    echo "<td>".$row["first_name"]."</td>";
                    echo "<td>".$row["last_name"]."</td>";
                    echo "<td>".$row["verified"]."</td>";
                    echo "<td><a class=\"btn btn-success\" href=\"verify.php?table=model&&id=".$row["model_id"]."\">Verify</a></td>";
                    // echo "<td><a class=\"btn btn-danger\" href=\"delete.php?table=model&&id=".$row["model_id"]."\">Delete</a></td>";
                    echo "</tr>";
                  }
                  echo "<table>";
                }
              }
              //Locations
              elseif (isset($_GET["id"]) && $_GET["id"] == 3) {
                $sql = "SELECT * FROM location";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  echo "<table class=\"table\">";
                  echo "<tr>";
                  echo "<th>ID</th>";
                  echo "<th>Name</th>";
                  echo "<th>City</th>";
                  echo "<th>Description</th>";
                  echo "<th>Verified</th>";
                  echo "<th></th>";
                  echo "</tr>";
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["location_id"]."</td>";
                    echo "<td>".$row["location_name"]."</td>";
                    echo "<td>".$row["city"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    echo "<td>".$row["verified"]."</td>";
                    echo "<td><a class=\"btn btn-success\" href=\"verify.php?table=location&&id=".$row["location_id"]."\">Verify</a></td>";
                    // echo "<td><a class=\"btn btn-danger\" href=\"delete.php?table=location&&id=".$row["location_id"]."\">Delete</a></td>";
                    echo "</tr>";
                  }
                  echo "<table>";
                }
              }
              //Bookings
              elseif (isset($_GET["id"]) && $_GET["id"] == 4) {
                $sql = "SELECT * FROM bookings";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  echo "<table class=\"table\">";
                  echo "<tr>";
                  echo "<th>ID</th>";
                  echo "<th>Date</th>";
                  echo "<th>photographer</th>";
                  echo "<th>Start Time</th>";
                  echo "<th>End Time</th>";    
                  echo "<th>model</th>";
                  echo "<th>location</th>";
                  echo "</tr>";
                  while ($row = $result -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["booking_id"]."</td>";
                    echo "<td>".$row["booking_date"]."</td>";
                    echo "<td>".$row["client_name"]."</td>";
                    echo "<td>".$row["start_time"]."</td>";
                    echo "<td>".$row["end_time"]."</td>";
                    echo "<td>".$row["photographer_approve"]."</td>";
                    echo "<td>".$row["model_approve"]."</td>";
                    echo "<td>".$row["location_approve"]."</td>";
                    echo "</tr>";
                  }
                  echo "<table>";
                }
              }
              else{
                echo "<h3 style=\"font-size: 100px; text-align: center; color: lightgrey; margin-top: 100px; margin-left: 300px;\">Msanii Admin<h3>";
              }
             ?>
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

    <?php if (isset($_SESSION["verified"]) && $_SESSION["verified"] === TRUE) : ?>
      <script type="text/javascript">
        alert("Verification successful!");
      </script>
    <?php unset($_SESSION["verified"]); endif; ?>

    <?php if (isset($_SESSION["deleted"]) && $_SESSION["deleted"] === TRUE) : ?>
      <script type="text/javascript">
        alert("Deletion successful!");
      </script>
    <?php unset($_SESSION["deleted"]); endif; ?>

</body>

</html>
