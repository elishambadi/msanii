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

  <title>Msanii - Search</title>

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
/*    #sidebar-wrapper{
      position: fixed;
    }*/
    #locName{
      font-size: 22px;
      text-align: center;
      margin-left: 20px;
    }
    .carousel-caption{
      font-size: 15px;
      font-weight: bolder;
    }
    #hover-img:hover{
      opacity: 1;
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
            <?php if (isset($_SESSION["username"])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION["username"]; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="uploadDP.php">Upload profile photo</a>
                <a class="dropdown-item" href="profile.php/delete=true">Delete photos</a>
              </div>
            </li>
            <?php endif; ?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
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

      <div class="container-fluid" style="text-align: center"><br>

        <form action="search.php" method="POST" enctype="multipart/form" class="form-inline">
          <label>Search by:&nbsp;&nbsp;</label>
          <select name="searchType" class="form-control">
            <option value="username">Username</option>
            <option value="expertise">Expertise</option>
          </select>&nbsp;&nbsp;&nbsp;&nbsp;
          <label for="userType">User type:&nbsp;&nbsp;</label>
          <select name="userType" class="form-control">
            <option value="photographers">Photographers</option>
            <option value="model">Models</option>
            <option value="location">Locations</option>
          </select>&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="search_name" placeholder="Search item" width="600px" class="form-control">
          &nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <br>
      </div>   
    <!-- /#page-content-wrapper -->
    <?php 
      require 'connect.php';
      //if (isset($_POST["username"]) || isset($_POST["userType"])) {
        if (isset($_POST["search_name"])) {
          $username = $_POST["search_name"];
          $username1 = str_replace(' ', '', $username); ##For displaying default seearch item is empty
        }
        if (isset($_POST["searchType"])) {
          $searchType = $_POST["searchType"];
        }
        if (isset($_POST["userType"])) {
          $table = $_POST["userType"];
          echo "<h4 style=\"text-align: center\">".strtoupper($table)."</h4>";
        }       
        
        //Start of location section
        if (isset($table) && $table == "location") {
          if ($username1 != "") {
            $sql = "SELECT * FROM location WHERE (location_name = '$username')";
          }else{
            $sql = "SELECT * FROM location";
          }
          
          $result = $conn -> query($sql);

          if ($result -> num_rows > 0) {
            echo "<div class=\"row\">";
            while ($row = $result -> fetch_assoc()) {
              echo "<div class=\"col-md-6\">";
              echo "<a href=\"location.php?id=".$row["location_id"]."\"><img class=\"img-thumbnail img-responsive\" style=\"width:500px; height:360px;\" id=\"hover-img\" src=\"locationImages/".$row["image_name"]."\"></a><br>";
              echo "<div class=\"carousel-caption\">".$row["location_name"]."</div>";
              echo "<b id=\"locName\">".$row["location_name"]."</b>";
              echo "</div>";
            }
            echo "</div>";
          }
          else{
            echo "<h5 style=\"text-align:center;\">No result</h5>";
          }
        }
        //End of location section

        //Start of photographer section
        elseif (isset($table) && $table == "photographers") {
          if ($searchType == "username" &&  $username1 != "") {
            $sql = "SELECT * FROM photographers WHERE username = '$username'";
          }
          elseif ($searchType == "expertise" && $username1 != "") {
            $sql = "SELECT * FROM photographers WHERE expertise = '$username'";
          }elseif ($username1 == "") {
            $sql = "SELECT * FROM photographers";
          }

          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table  class=\"table\">";
            echo "<tr>";
            echo "<th>Username</th>";
            echo "<th>Email</th>";
            echo "<th>Expertise</th>"; 
            echo "</tr>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>";
              echo "<td> <a href= \"".$table.".php?id=".$row["photographer_id"]."&&userType=".$table."\">".$row["username"]."</a></td>";
              echo "<td>".$row["email"]."</td>";
              if ($table == "photographers") {
                echo "<td>".$row["expertise"]."</td>";
              }
              echo "</tr>";
            };
            echo "</table>";
          }
          else{
            echo "<h3 style=\"text-align:center; color: grey; margin-top: 100px;\">No result</h3>";
          }
        }
        //End of photographer section

        //Start of model section
        elseif (isset($table) && $table == "model") {
          if ($username1 != "") {
            $sql = "SELECT * FROM model WHERE (username = '$username')";
          }else{
            $sql = "SELECT * FROM model";
          }
        
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table  class=\"table\">";
            echo "<tr>";
            echo "<th>Username</th>";
            echo "<th>Email</th>";
            echo "</tr>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>";
              echo "<td> <a href= \"".$table.".php?id=".$row["model_id"]."&&userType=".$table."\">".$row["username"]."</a></td>";
              echo "<td>".$row["email"]."</td>";
              echo "</tr>";
            };
            echo "</table>";
          }
          else{
            echo "<h3 style=\"text-align:center; color: grey; margin-top: 100px;\">No result</h3>";
          }
        }
        else{
          echo "<h4 style=\"text-align:center;\">Photographers</h4>";
          $sql = "SELECT * FROM photographers";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table class=\"table\">";
            echo "<tr>";
            echo "<th>Username</th>";
            echo "<th>Email</th>";
            echo "<th>Expertise</th>";
            echo "</tr>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>";
              echo "<td> <a href= \"photographers.php?id=".$row["photographer_id"]."&&userType=photographers\">".$row["username"]."</a></td>";
              echo "<td>".$row["email"]."</td>";
              echo "<td>".$row["expertise"]."</td>";
              echo "</tr>";
            };
            echo "</table>";
          }
        }
        //}
     ?>

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
