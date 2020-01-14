<?php
include("db.php");
session_start();

$message = $_POST["message"];
$username = $_SESSION["loggedin"];
$date = date("H:i d.m.Y ");
$ip = $_SERVER["REMOTE_ADDR"];

$illegal = array('<script>','<?php','?>','<=','<');
$message = preg_replace("/[^a-zA-Z0-9 ?]/", "", $message);

if($message==""){
    exit;
}else if(strpos($message,$illegal)){
    exit;
}

$query = mysqli_query($con, "INSERT INTO messages(message, username, date, ip) VALUES ('$message','$username','$date','$ip')");

echo $message;