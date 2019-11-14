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

  <title>Msanii - Locations</title>

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
        <h4 style="text-align: center;">View Locations</h4>
        <div class="row">
        <div class="col-md-11">
          <a href="addLocation.php" class="btn btn-info">Add location</a>
          <!-- Display locations in a table format -->
          <?php 
            require 'connect.php';

            //Display owner ID
            $username = $_SESSION["username"];
            $sql = "SELECT owner_id FROM owner WHERE (username = '$username')";
            $result = $conn -> query($sql);

            if ($result -> num_rows > 0) {
              while ($row = $result -> fetch_assoc()) {
                $owner_id = $row["owner_id"];
              }
            };
            //Display photographer ID closed

            //Test statement
            $sql = "SELECT * FROM location WHERE (owner_id = '$owner_id')";
            $result = $conn -> query($sql);
            if ($result -> num_rows > 0) {
              echo "<table class=\"table\">";
              echo "<tr>";
              echo "<th>ID</th>";
              echo "<th>Image</th>";
              echo "<th>Name</th>";
              echo "<th>City</th>";
              echo "<th>Description</th>";
              echo "<th>Verified</th>";  
              // echo "<th></th>";           
              echo "</tr>";
              $n = 1; //ID Counter
              while ($row = $result -> fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$n."</td>";
                echo "<td><img width=\"300px\" height=\"200px\" src=\"locationImages/".$row["image_name"]."\"></td>";
                echo "<td>".$row["location_name"]."</td>";
                echo "<td>".$row["city"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td>".$row["verified"]."</td>";
                // echo "<td><a class=\"btn btn-info add-Photo\" data-id=\"".$row["location_id"]."\" data-target=\"#myModal\" data-toggle=\"modal\">Add image</a></td>";
                echo "</tr>";
                $n = $n+1; //Increment to display IDs
              }
              echo "</table>";
            }
           ?>
        </div>
        <!-- Edit bio popup -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Upload location image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
                  </div>
                  <div class="modal-body">
                    <form action="addLocationBE.php" method="POST">
                      <label for="image_upload">Select Image: </label>
                      <input type="file" name="image_upload" onchange="preview_image(event)" id="image_upload" class="form-control-file" required="required"><br>
                      <input type="hidden" name="locID" id="locID">
                      <img id="outputImage" width="400px" height="320px">
                      <input type="submit" name="submit" value="Upload" class="btn btn-success">&nbsp;&nbsp;&nbsp;
                      <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- Close edit bio -->
        <div class="col-md-4">
          <img id="outputImage" width="400px" height="320px">
        </div>
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

  <script type='text/javascript'>
    $(document).on("click", ".add-Photo", function(){
      var locID = $(this).data('id');
      $(".modal-body #locID").val(locID);
    });

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
    </script>


</body>

</html>
