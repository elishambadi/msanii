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
              <a class="nav-link text-success" href="#">Login</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" style="text-align: center">
        <h1 class="mt-4">Sign Up</h1>
        <form action="signUPBE.php" method="POST" class="col-md-4" style="margin-right: auto; margin-left: auto;">
          <label>First Name: </label>
          <input type="text" name="fName" class="form-control"><br>
          <label>Last Name: </label>
          <input type="text" name="lName" class="form-control"><br>
          <?php if (isset($_GET["type"]) && $_GET["type"] == "photographers"): ?>
            <label>Expertise: </label>
          <input type="text" name="expertise" class="form-control"><br><br>
          <?php endif; ?>
          <label>Email: </label>
          <input type="Email" name="email" class="form-control"><br>
          <!-- Display phone number for owners -->
          <?php if (isset($_GET["type"]) && ($_GET["type"] == "owner")):?>
            <label>Phone number:</label>
            <input type="text" name="pNumber" class="form-control"><br>
          <?php endif; ?>
          <!-- Hide username for owners -->
          <?php if (isset($_GET["type"]) && ($_GET["type"] == "photographers" || $_GET["type"] == "model")): ?>
          <label>Username: </label>
          <input type="text" name="username" class="form-control"><br>
          <?php endif; ?>
          <label>Password: </label>
          <input type="password" name="password" class="form-control"><br>
          <label>Confirm password: </label>
          <input type="password" name="password2" class="form-control"><br>
          <input type="hidden" name="userType" value= 
          <?php
            if (isset($_GET["type"])) {
              echo "\"".$_GET["type"]."\"";
            }     
          ?>
          ><br>
          <input type="submit" name="submit" value="Sign Up!" class="btn btn-success"><br><br>
          <?php if ($_GET["type"] !== "clients"): ?>
          <a href="login.php" class="btn btn-info">Already signed up?</a>
          <?php else: ?>
          <a href="clients/login.php" class="btn btn-info">Already signed up?</a>
          <?php endif; ?>
        </form>
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
