<?php
include("dbconnect.php");
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $sql="select * from reg where email='$email' and password='$pass'";
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)>0){
        header('location:index.php');
        exit();
    }
    else{
        header('location:login.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <form method="POST">
        Email:<input type="text" name="email" id="email">
        
        password:<input type="text" name="password" id="password">
        

        <button type="submit" name="submit">submit</button>
    </form>

</body>

</html>