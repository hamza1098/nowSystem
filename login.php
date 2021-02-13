<?php
session_start();
    if(isset($_COOKIE['username']))
    {
        $_SESSION['username'] = $_COOKIE['username'];
    }
    if(isset($_SESSION['username']))
    {
        header('location:profile.php');
        exit();
    }
    if(isset($_POST['send']))
    {
        $username = $_POST["username"];
        $password =$_POST["password"];
        $conn = mysqli_connect("localhost","root",null,"log");
        $resut = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password= '$password'");
    }
    if($resut->num_rows >0){
        $_SESSION['username'] = $username;
        if(isset($_POST['remember']))
        {
            setcookie("username",$username,time() + 86400);
        }
    }
  ?>

<form action="login.php" method="POST" style="margin-left: 100px;">
    <input type="text" name="username" placeholder="username"/></br></br>
    <input type="text" name="password" placeholder="password" /></br></br>
    <label>rememberme</label>
    <input type="checkbox" name="remember"/></br/></br>
    <input type="submit" name="send" />
</form>