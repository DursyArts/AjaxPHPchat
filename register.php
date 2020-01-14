<?php
include("db.php");

if(isset($_SESSION["loggedin"])){
    header("Location: index.php");
}

if(isset($_POST["register"])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con,$username);
    $query = mysqli_query($con, "SELECT * FROM user WHERE user = '$username'");

    $num_rows = mysqli_num_rows($query);
    if($num_rows>0){
        echo "User already exists: <a href='/register.php'>back </a>";
        exit();
    }

    if(!$_REQUEST['password']|| !$_REQUEST['username']){
        echo "nigga enter a username or password";
    }else{
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con,$username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con,$email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);
        $hsh_passwd = password_hash($password, PASSWORD_DEFAULT);

        $ip = $_SERVER["REMOTE_ADDR"];
        $date = date("d.m.Y - H:i");
        $query = mysqli_query($con, "INSERT INTO `user` (user, password, ip, email, date) 
                                    VALUES ('$username', '$hsh_passwd', '$ip' , '$email', '$date')");

        if($query){
            header("Location: index.php");
        }else{

        }
    }
}

?>
<p> register </p>
<form action="register.php" method="post">
    <input type="text" placeholder="email" name="email"></input><br><br>
    <input type="text" placeholder="username*" name="username"></input><br><br>
    <input type="password" placeholder="password*" name="password"></input><br><br>
    <input type="submit" name="register">
</form>

<p>*required</p>