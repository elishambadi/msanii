<?php 
    require 'connect.php';

    $userType = $_POST["userType"];
    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];
    $username = $_POST["username"];
    if ($userType == "photographer") {
      $expertise = $_POST["expertise"];
    }
    if ($userType == "owner") {
      $pNumber = $_POST["pNumber"];
    }
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $password2 = md5($_POST["password"]);

    //Add validation for usernames to be unique

    if ($userType == "photographers") {

      if (isset($_POST["submit"])) { //Ensures html form validation is done
        if ($password === $password2) {
          $sql = "INSERT INTO ".$userType." (first_name, last_name, username, expertise, email, password)
          VALUES ('$firstName', '$lastName', '$username', '$expertise', '$email', '$password')";

          if ($conn -> query($sql) === TRUE) {
            echo "Successful sign up";
            header('Location: login.php');
          }
          else{
            echo "Error logging in!".$conn->error;
          }
        }
        else{
          echo "<script>alert(\"Passwords do not match!\");</script>";
        };
      };
    };

    //Add data to models table
    if ($userType == "model") {

      if (isset($_POST["submit"])) { //Ensures html form validation is done
        if ($password === $password2) {
          $sql = "INSERT INTO ".$userType." (first_name, last_name, username, email, password)
          VALUES ('$firstName', '$lastName', '$username', '$email', '$password')";

          if ($conn -> query($sql) === TRUE) {
            echo "Successful sign up";
            header('Location: login.php');
          }
          else{
            echo "Error logging in!".$conn->error;
          }
        }
        else{
          echo "<script>alert(\"Passwords do not match!\");</script>";
        };
      };
    };

    //Add data to models table
    if ($userType == "owner") {

      if (isset($_POST["submit"])) { //Ensures html form validation is done
        if ($password === $password2) {
          $sql = "INSERT INTO ".$userType." (first_name, last_name, phone_number, email, password) VALUES ('$firstName', '$lastName', '$pNumber', '$email', '$password')";

          if ($conn -> query($sql) === TRUE) {
            echo "Successful sign up";
            header('Location: login.php');
          }
          else{
            echo "Error logging in!".$conn->error;
          }
        }
        else{
          echo "<script>alert(\"Passwords do not match!\");</script>";
        };
      };
    };

    if ($userType == "clients") {

      if (isset($_POST["submit"])) { //Ensures html form validation is done
        if ($password === $password2) {
          $sql = "INSERT INTO ".$userType." (first_name, last_name, email, password)
          VALUES ('$firstName', '$lastName', '$email', '$password')";

          if ($conn -> query($sql) === TRUE) {
            echo "Successful sign up";
            header('Location: clients/login.php');
          }
          else{
            echo "Error logging in!".$conn->error;
          }
        }
        else{
          echo "<script>alert(\"Passwords do not match!\");</script>";
        };
      };
    };

?>
