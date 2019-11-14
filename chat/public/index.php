<?php 
    session_start();
    $username1 = $_GET["name"];
    $username2 = $_SESSION["username"];//Client username
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="./css/styles.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <title>Msanii Chat Room | Join</title>
</head>
<body class="centered-form">
    <div class="centered-form__form">
        <form action="chat.php">
        <div class="form-field">
            <h1>Msanii Chat Room</h1>
            <h3>Join a chat</h3>
        </div>
        <div class="form-field">
            <!-- <label for="showing name">Username: </label> -->
            <input type="hidden" name="name1" value=
            <?php echo $username2; ?>
             autofocus>

             <input type="hidden" name="name2" value=
            <?php echo $username1; ?>
             autofocus>
        </div>
        <div class="form-field">
            <!-- <label for="group name">Room name</label> -->
            <input type="hidden" name="room" value=
            <?php 
                //Roomname is MD5 of client username
                $roomName = md5($username2);
                echo $roomName;
             ?>
            >
        </div>
        <div class="form-field">
            <button>Start chat</button>
        </div>
        </form>
    </div>
</body>
</html>