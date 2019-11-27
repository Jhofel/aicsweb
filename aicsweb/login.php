<?php 
session_start();
if(isset($_SESSION['user'])){
    header("location:index.php");
}
include_once ('myconfig.php');
if(isset($_POST['login'])){
   $susername = $_POST['username'];
   $spassword = $_POST['password'];
   $sql = "select * from aicswebdb.aics where username = :user && password = :pass";
   $query = $conn -> prepare($sql);
   $query -> bindParam(':user', $susername);
   $query -> bindParam(':pass', $spassword);
   $query -> execute();
   while($row = $query->fetch(PDO::FETCH_ASSOC)){
       $nickname = $row['nickname'];
   }
​
    $result = $query->rowCount();
    if($result > 0){
        $_SESSION['user'] = "ok";
        $_SESSION['nickname'] = $nickname;
        header("location:index.php");
    }
    else
    {
        echo "Error: Wrong Username or Password";
    }
​
​
}
?>
​
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="">Username</label><br>
        <input type="text" name="username"><br>
        <label for="">Password</label><br>
        <input type="password" name="password"><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>