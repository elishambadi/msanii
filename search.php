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
    table{
      /*border: 1px solid black;*/
      width: 100%;
      margin: 0px 50px 0px 50px;
    }
    th{
      height: 50px;
      background-color: darkblue;
      color: white;
    }
    td, th{
      padding: 10px 15px ;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    tr:nth-child(even){
      background-color: #f5f5f5;
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Search
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Models</a>
                <a class="dropdown-item" href="#">Photographers</a>
                <a class="dropdown-item" href="#">Locations</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <br>
        <form action="search.php" method="POST">
          <select name="userType">
            <option value="photographers">Photographers</option>
            <option value="model">Models</option>
            <option value="location">Locations</option>
          </select>
          <input type="text" name="search_name" placeholder="Search item" width="600px" class="form-group">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>   
    <!-- /#page-content-wrapper -->
    <?php 
      require 'connect.php';
      if (isset($_POST["username"]) || isset($_POST["userType"])) {
        $username = $_POST["search_name"];
        $table = $_POST["userType"];
        echo "<h4 style=\"text-align: center\">".strtoupper($table)."</h4>";

        if ($table = "location") {
          $sql = "SELECT * FROM location WHERE (location_name = '$username')";
          $result = $conn -> query($sql);

          if ($result -> num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Location</th>";
            echo "<th>City</th>";
            echo "<th>Email</th>";
            echo "</tr>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>";
              echo "<th>".$row["location_name"]."</th>";
              echo "<th>".$row["city"]."</th>";
              echo "<th>".$row["email"]."</th>";
              echo "</tr>";
            }
            echo "<table>";
          }
        }

        if ($table == "photographers") {
        $sql = "SELECT * FROM photographers WHERE (username = '$username')";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Username</th>";
            echo "<th>Email</th>";
            echo "<th>Expertise</th>"; 
            echo "</tr>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>";
              echo "<td> <a href= \"".$table.".php?username=".$username."&&userType=".$table."\">".$row["username"]."</a></td>";
              echo "<td>".$row["email"]."</td>";
              if ($table == "photographers") {
                echo "<td>".$row["expertise"]."</td>";
              }
              echo "</tr>";
            };
            echo "</table>";
          }
        }

        if ($table == "model") {
        $sql = "SELECT * FROM model WHERE (username = '$username')";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Username</th>";
            echo "<th>Email</th>";
            echo "</tr>";
            while ($row = $result -> fetch_assoc()) {
              echo "<tr>";
              echo "<td> <a href= \"".$table.".php?username=".$username."&&userType=".$table."\">".$row["username"]."</a></td>";
              echo "<td>".$row["email"]."</td>";
              echo "</tr>";
            };
            echo "</table>";
          }
        }
      }
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
