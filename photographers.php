<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Msanii - Photographer</title>

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
    #locImg{
      width: 500px;
      height: 400px;
      margin: 10px;
    }
    #profileImg{
      width : 200px;
      height: 200px;
      border-radius: 50%;
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
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
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
                <a class="dropdown-item" href="#">Models</a>
                <a class="dropdown-item" href="#">Photographers</a>
                <a class="dropdown-item" href="#">Locations</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <?php 
          require 'connect.php';

          $photographer_id = $_GET["id"];
          $sql = "SELECT * FROM photographers WHERE (photographer_id = '$photographer_id')";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
          while ($row = $result -> fetch_assoc()) {
            $photographer_name = $row["username"];

            //Display profile image
            $sql = "SELECT image_name FROM profileimages WHERE username='".$row["username"]."'";
            $result1 = $conn -> query($sql);
            if($result1 -> num_rows > 0){
              while ($row2 = $result1 -> fetch_assoc()) {
                echo "<img id=\"profileImg\" src=\"profilePics/".$row2["image_name"]."\">";
              }
            }
              //End display profile image
              echo "<h3>".$photographer_name."</h3>";
              echo "<h4>".$row["expertise"]."</h4>";
              echo "<h4>".$row["bio"]."</h4>";
              echo "<h4>".$row["email"]."</h4>";
              echo "<h4><a class=\"btn btn-primary\" href=\"booking.php?photoID=".$row["photographer_id"]."\">Book Now</a></h4>";
            

            }
          }

          $sql = "SELECT * FROM images WHERE (photographer_id = '$photographer_id')";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
              echo "<img src = \"uploads/".$row["image_name"]."\" id=\"locImg\">";
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

</body>

</html>
