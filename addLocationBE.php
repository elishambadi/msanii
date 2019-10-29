<?php 
  session_start();
  require 'connect.php';

  //Upload file to server
  $target_dir = "locationImages/"; //Code is reusable only modify this line
  $target_file = $target_dir.basename($_FILES["image_upload"]["name"]);
  $uploadOK = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image_upload"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image".$check["mime"].".";
      $uploadOK = 1;
    }
    else{
      echo "File is not an image";
      $uploadOK = 0;
    }
  }

  if ($uploadOK == 0) {
    echo "Sorry, your file was not uploaded";
  }
  else{
    if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
      echo "The file".$_FILES["image_upload"]["name"]." has been uploaded";
    }
    else{
      echo "Sorry, there was an error uploading your file.";
    }
  }
  //End upload file to server

  //Display owner ID
  $username = $_SESSION["username"];
  echo $username;
  $sql = "SELECT owner_id FROM owner WHERE (username = '$username')";
  $result = $conn -> query($sql);

  if ($result -> num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
      $owner_id = $row["owner_id"];
    }
  };
  //Display photographer ID closed

  $image_name = basename($_FILES["image_upload"]["name"]);
  $name = $_POST["name"];
  $city = $_POST["city"];
  $description = $_POST["description"];
  $sql = "INSERT INTO location(location_name, city, description, image_name, owner_id) 
  VALUES('$name', '$city', '$description', '$image_name', '$owner_id')";

  if ($conn -> query($sql) === TRUE) {
    echo "Location added successfully";
    header('Location: viewLocations.php');
  }
?>