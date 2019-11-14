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
    #profile-info{
      margin-top: 20px;
      text-align: left;
    }
    .hoverImg{
      position:relative;
      padding:0;
      display:block;
      width: 500px;
      height: 400px;
      margin: 10px;
      cursor:pointer;
      overflow:hidden;
    }
    .content{
      opacity:0;
      font-size: 40px;
      position:absolute;
      top:0;
      left:0;
      color:#1c87c9;
      background-color:rgba(200,200,200,0.5);
      width: 500px;
      height: 400px;
      margin: 10px;
      -webkit-transition: all 400ms ease-out;
      -moz-transition: all 400ms ease-out;
      -o-transition: all 400ms ease-out;
      -ms-transition: all 400ms ease-out;
      transition: all 400ms ease-out;
      text-align:center;
    }
    .hoverImg .content:hover{
      opacity: 1;
    }
    .hoverImg .content .text{
      height:0;
      opacity:1;
      transition-delay: 0s;
      transition-duration: 0.5s;
      color: white;
    }
    .hoverImg .content:hover .text{
      opacity:1;
      transform: translateY(250px);
      -webkit-transform: translateY(250px);
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
        <?php 
          require 'connect.php';
          echo "<div class=\"row\">";
          echo "<div class=\"col-md-4\">";
          $model_id = $_GET["id"];
          $sql = "SELECT * FROM model WHERE (model_id = '$model_id')";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
          while ($row = $result -> fetch_assoc()) {
            $model_name = $row["username"];

            //Display profile image
            $sql = "SELECT image_name FROM profileimages WHERE username='".$row["username"]."'";
            $result1 = $conn -> query($sql);
            if($result1 -> num_rows > 0){
              while ($row2 = $result1 -> fetch_assoc()) {
                echo "<img id=\"profileImg\" src=\"profilePics/".$row2["image_name"]."\">";
              }
            }
            else{
              echo "<img id=\"profileImg\" src=\"assets/avatar.png\">";
            }
              //End display profile image
              echo "<h4>".$model_name."</h4>";
              echo "</div>";
              echo "<div class=\"col-md-8\" id=\"profile-info\">";
              echo "<h5>Email: ".$row["email"]."</h5>";
              echo "<div class=\"row\"><h5><a class=\"btn btn-primary\" href=\"booking.php?modelID=".$row["model_id"]."\">Book Now</a></h5>&nbsp;&nbsp;";
              echo "<h5><a class=\"btn btn-primary\" href=\"chat/public/index.php?name=".$row["username"]."\">Chat</a></h5></div>";
              echo "</div>";
              echo "</div>";

            }
          }
          echo "<div class=\"row\">";
          $sql = "SELECT * FROM images WHERE (model_id = '$model_id')";
          $result = $conn -> query($sql);
          if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
              echo "<div class=\"hoverImg\">";
              echo "<img class=\"img-thumbnail\" src = \"uploads/".$row["image_name"]."\" id=\"locImg\">";
              echo "<div class=\"content\">";
              echo "<div class=\"text\">@";
                $sql = "SELECT location_name FROM location WHERE location_id ='".$row["location_id"]."'";
                $result1 = $conn -> query($sql);
                if ($result1 -> num_rows > 0) {
                  while ($row1 = $result1 -> fetch_assoc()) {
                    echo "<a href=\"location.php?id=".$row["location_id"]."\">".$row1["location_name"]."</a>";
                  }
                }
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
          }
          echo "</div>"
         ?>
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
