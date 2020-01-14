<?php
include("db.php");
session_start();
?>

<html lang="de">
<head>
    <title>Ajax PHP</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>


<!--display Messages-->
<div id="message-container">

</div>

<!-- display send message -->
<div id="send-message-container">
    <?php

    $ip = $_SERVER["REMOTE_ADDR"];
    if(isset($_SESSION['loggedin'])){
        $username = $_SESSION["loggedin"];
        echo '<form id="postMessage">
                <input type="text" maxlength="500" name="message" id="message-value" autocomplete="off" placeholder="message"/>
                <input type="submit" value="send"/>
              </form>';
        echo '<div id="user-info">logged in as: '.$username. ' IP:' . $ip .'<a href="logout.php">logout</a></div>';
    }else{
        include("login.php");
    }
    ?>
</div>

</body>
</html>
<script>
    // call once
    $(document).ready(function(){
        $("#message-container").load("getMessage.php");
    });

    //call every 5 seconds
    setInterval(function (){
        $(document).ready(function(){
            $("#message-container").load("getMessage.php");
        });
        console.log("messages refreshed");
    }, 1000);

    // ajax data
    $("#postMessage").submit(function(){
       $.post("sendMessage.php",$("#postMessage").serialize(),function(data){});
       $("#message-value").val("");
       return false;
    });
</script>