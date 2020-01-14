<?php
//Database Connector
include("db.php");

//sql query
$sql = "SELECT * FROM messages ORDER BY ID DESC";
$result = mysqli_query($con, $sql);

//Fetch Messages from Database
while($message = mysqli_fetch_assoc($result)){
    echo "<div id='message'>"
        .$message['message'].
            "<div id='message-sender'>"
                 ." ". $message['username']." - id:".$message['ID']." - ".$message['date']. "
            </div>
        </div>";
}