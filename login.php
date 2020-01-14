<?php
include("db.php");

echo "<p>Login</p>";

//display Session
if(isset($_SESSION["loggedin"])){
    header("Location: index.php");
}


if(isset($_POST["login"])){
    $username = mysqli_escape_string($con, $_POST["username"]);
    $password = mysqli_escape_string($con, $_POST["password"]);

    $query = mysqli_query($con, "SELECT * FROM user WHERE user = '$username'");

    $row = mysqli_fetch_array($query);

    // password hash from db
    $hsh_passwd = $row[2];
    $validpw = password_verify($password,$hsh_passwd);

    $num_row = mysqli_num_rows($query);

    if($validpw == 1){
        $_SESSION["loggedin"] = $username;
        header("Location: index.php");
    }else{
        echo "<p>Auth failed.</p>";
    }

}

?>

<form action="index.php?pag=login" method="post">
    <input type="text" name="username" placeholder="username"></input>
    <input type="password" name="password" placeholder="password"></input>
    <input type="submit" name="login"></input>
</form>
<a href="register.php">register</a>