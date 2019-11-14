<?php 
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <title>Msanii Chat Room | Chat</title>
</head>
<body class="chat">
    <?php 
        // require '../../connect.php';
        // $client = $_GET["name1"];//Chat starter
        // $user = $_GET["name2"];
        // $roomNo = $_GET["room"];
        // $sql = "INSERT INTO chats(user1, user2, roomNo) VALUES ('$client', '$user', '$roomNo')";
        // if ($conn -> query($sql) === TRUE) {
            
        // }
        // else{
        //     echo "Failed to insert to DB";
        // }
     ?>
    <div class="chat__sidebar">
        <h3>Online users</h3>
        <div id="users"></div>
    </div>
    <div class="chat__main">
        <ol id="messages" class="chat__messages">
        </ol>
        <div class="chat__footer">
            <form id="message-form">
                <input name="message" type="text" placeholder="Message" autofocus autocomplete="off"/>
                <button>Send</button>
            </form>
            <button id="send-location">Send location</button>
        </div>
    </div>
    
    <script id="message-template" type="text/template">
        <li class="message">
            <div class="message__title">
                <h4>{{from}}</h4>
                <span>{{createdAt}}</span>
            </div>
            <div class="message__body">
                <p>{{text}}</p>
            </div>
        </li>
    </script>
    <script id="location-message-template" type="text/template">
        <li class="message">
            <div class="message__title">
                <h4>{{from}}</h4>
                <span>{{createdAt}}</span>
            </div>
            <div class="message__body">
                <a href="{{url}}" target="_blank">My current location</a>
            </div>
        </li>
    </script>

    

    <script src="./socket.io/socket.io.js"></script>
    <script src="./js/libs/jquery-3.1.0.min.js"></script>
    <script src="./js/libs/moment.js"></script>
    <script src="./js/libs/mustache.js"></script>
    <script src="./js/libs/deparam.js"></script>
    <script src="./js/chat.js"></script>
</body>
    
</html>
    