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

  <title>Msanii - Profile</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <!-- Fontawesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Pop up form CSS -->
  <link rel="stylesheet" type="text/css" href="popup.css">

  <style type="text/css">
    .row {
      display: flex;
      flex-wrap: wrap;
      padding: 0 4px;
    }

    /* Create two equal columns that sits next to each other */
    .column {
      flex: 33.33%;
      padding: 0 4px;
    }

    .column img {
      margin-top: 8px;
      vertical-align: middle;
    }
    .col-md-4{
      padding: 10px;
    }
/*    #sidebar-wrapper{
      position: fixed;
    }*/
  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading" style="font-size: 42px">
        <i class="fa fa-camera-retro" style="font-size: 32px"></i>&nbsp;Msanii
      </div>
      <?php if ($_SESSION["userType"] == "owner"):?>
        <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="viewLocations.php" class="list-group-item list-group-item-action bg-light">View locations</a>
        <a href="viewBookings.php" class="list-group-item list-group-item-action bg-light">View bookings</a>
      </div>
      <?php else: ?>
      <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="booking.php" class="list-group-item list-group-item-action bg-light">Bookings</a>
        <a href="uploadPhoto.php" class="list-group-item list-group-item-action bg-light">Upload photo</a>
      </div>
    <?php endif; ?>
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
            <?php if (isset($_SESSION["username"])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION["username"]; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="uploadDP.php">Upload profile photo</a>
                <a class="dropdown-item" href="profile.php/delete=true">Delete photos</a>
                <a class="dropdown-item" href="#">Set background image</a>
              </div>
            </li>
            <?php endif; ?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Support</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Search
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="search.php?userType=models">Models</a>
                <a class="dropdown-item" href="search.php?userType=photographers">Photographers</a>
                <a class="dropdown-item" href="search.php?userType=location">Locations</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <!-- Display user session message -->
        <!--  <h4 style="text-align: center">Welcome ["user"]</h4> -->

        <h4 style="text-align: center">Welcome <?php echo $_SESSION["username"];?></h4>
        <!-- Div to hold user stats and other details -->
        <div class="row">
          <div class="col-md-4">
            <img
            <?php 
              require 'connect.php';

              $username = $_SESSION["username"];
              $sql = "SELECT image_name FROM profileimages WHERE (username = '$username')";
              $result = $conn -> query($sql);
              if ($result -> num_rows > 0) {
                 while ($row = $result -> fetch_assoc()) {
                   echo "src = \"profilePics/".$row["image_name"]."\"";
                 }
               }
               else {
                echo "src = \"assets/avatar.png\"";
              };
             ?>
             width="200px" height="200px" style="border-radius: 50%"><br>
             <!-- Display DP close -->

          </div>

          <!-- Display profile info -->
          <div class="col-md-8" style="text-align: left; vertical-align: middle; padding-top: 20px;">
            <h5><?php echo $_SESSION["username"];?></h5>
            <!-- Creating a popup -->
            <div class="form-popup" id="myForm" onclick="myFunction()">
              <form action="editBio.php" class="form-container" method="post">
                <label for="bio">Enter Bio: </label>
                <input type="text" name="bio" placeholder="Enter bio..."><br>
                <button type="submit" class="btn-success">Done!</button>
                <button type="submit" class="btn-danger" onclick="closeForm()">Close</button>
              </form>
            </div>

            <script type="text/javascript">
              function openForm(){
                document.getElementById("myForm").style.display="block";
              }
              function closeForm(){
                document.getElementById("myForm").style.display="none";
              }
            </script>

            <?php
            require 'connect.php';
            //Define username and table
              $username = $_SESSION["username"];
              $table = $_SESSION["userType"];

              if ($table == "photographers") {
                //Display photographer ID
                $sql = "SELECT photographer_id FROM photographers WHERE (username = '$username')";
                $result = $conn -> query($sql);

                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    $photographer_id = $row["photographer_id"];
                  }
                };
                //Display photographer ID closed

                $sql = "SELECT verified, bio FROM photographers WHERE (photographer_id = '$photographer_id')";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    if ($row["verified"] == 'YES') {
                      echo "Verified ";
                      echo "<i class = \"fa fa-check-circle \" style= \"font-size: 20px\"></i><br>";
                    }
                    else{
                      echo "Not verified<br>";
                    }
                      echo "Bio:".$row["bio"].".<br> <button class=\"btn btn-info\" onclick=\"openForm()\">Edit bio</button>";
                  }
                }
              }

              if ($table == "model") {
                //Display model ID
                $sql = "SELECT model_id, bio FROM model WHERE (username = '$username')";
                $result = $conn -> query($sql);

                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    $model_id = $row["model_id"];
                  }
                };
                //Display model ID closed

                $sql = "SELECT verified FROM model WHERE (model_id = '$model_id')";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()) {
                    if ($row["verified"] == 'YES') {
                      echo "Verified ";
                      echo "<i class = \"fa fa-check-circle \" style= \"font-size: 20px\"></i>";
                    }
                    else {
                      echo "Not verified";
                    }
                  }
                }
              }
              
            ?>
          </div>
        </div>
        <!-- End of profile info -->

        <!-- Display images -->
        <?php 
          require("connect.php");
          //For testing purposes
          $table = $_SESSION["userType"];
          $username = $_SESSION["username"];

          if ($table == "photographers") {
            //Get photographer_ID
            $sql = "SELECT photographer_id FROM photographers WHERE (username = '$username')";
            $result = $conn -> query($sql);

            if ($result -> num_rows > 0) {
              while ($row = $result -> fetch_assoc()) {
                $photographer_id = $row["photographer_id"];
              }
            };
            //Display model ID closed

            $sql = "SELECT image_name, caption, location_id, image_id FROM images WHERE (photographer_id = 
            '$photographer_id')";
            $result = $conn -> query($sql);
            if ($result -> num_rows > 0) {

              echo "<div class = \"row\"><div class=\"col-md-4\">";
              $counter = 0; //Counter to display divs
              while ($row = $result -> fetch_assoc()) {
                $counter++;
                echo "<img src = uploads/".$row["image_name"]." width=\"300px\" height =\"250px\">";
                echo "<a style=\"margin-left: 30px\" class=\"btn btn-primary\" href = \"delete.php?id=".$row["image_id"]."\">Delete</a><br>";
                echo $row["caption"];

                //Code to display location name as a hyperlink
                $location_id = $row["location_id"];
                $sql = "SELECT location_name, location_id FROM location WHERE (location_id = '$location_id')";
                $result1 = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result1 -> fetch_assoc()) {
                    echo "@"."<a href=\"location.php?id=".$row["location_id"]."\">".$row["location_name"]."</a><br>";
                  }
                }
                  echo "</div><div class = \"col-md-4";
                }
                echo "</div>";//Closing row div
            }
          }

          if ($table == "model") {
          //Get photographer_ID
            $sql = "SELECT model_id FROM model WHERE (username = '$username')";
            $result = $conn -> query($sql);

            if ($result -> num_rows > 0) {
              while ($row = $result -> fetch_assoc()) {
                $model_id = $row["model_id"];
              }
            };
            //Display model ID closed

            $sql = "SELECT image_name, caption, location_id, image_id FROM images WHERE (model_id = 
            '$model_id')";
            $result = $conn -> query($sql);
            if ($result -> num_rows > 0) {

              echo "<div class = \"row\">";
              $counter = 0; //Counter to display divs
              while ($row = $result -> fetch_assoc()) {
                $counter++;
                echo "<img src = uploads/".$row["image_name"]." width=\"400px\" height =\"250px\">";
                echo "<a style=\"margin-left: 30px\" class=\"btn btn-primary\" href = \"delete.php?id=".$row["image_id"]."\">Delete</a><br>";
                echo $row["caption"];

                //Code to display location name as a hyperlink
                $location_id = $row["location_id"];
                $sql = "SELECT location_name, location_id FROM location WHERE (location_id = '$location_id')";
                $result1 = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                  while ($row = $result1 -> fetch_assoc()) {
                    echo "@"."<a href=\"location.php?id=".$row["location_id"]."\">".$row["location_name"]."</a><br>";
                  }
                }
              }
            }
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

  <script type='text/javascript'>
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
