<?php
SESSION_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
    exit();
}
echo "username of users " . $_SESSION['username'];
$username =$_SESSION['username'];


$conn = mysqli_connect('localhost','root',null,'log');
if(isset($_POST['btn']))
{
        $new_username= $_POST['username'];
        $new_email= $_POST['email'];
        $new_phone= $_POST['phone'];
        $new_result = mysqli_query(
        $conn, "UPDATE user SET
        username = '$new_username',
        Email ='$new_email',
        phone = '$new_phone' 
        WHERE username= '$username'
        "
    );
    if($new_result){
        echo "saved";
        $username = $new_username;
        $_SESSION['username'] = $new_username;
    }
    else{
        echo "Error";
    }
}
    $result = mysqli_query(
        $conn, 
        "SELECT * FROM user
        WHERE username ='$username' "
);
$user = mysqli_fetch_assoc($result);
?>
<form action="profile.php" method="POST">
    <input type="text" name="username" 
    value="<?= $user['username']?>"
    placeholder="username" />
    <input type="text" name="email" 
    value="<?= $user['Email']?>"
    placeholder="email" />
    <input type="text" name="phone" 
    value="<?= $user['phone']?>"
    placeholder="phone" />
    <input type="submit" name="btn">
</form>