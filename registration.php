<?php
include("dbconnect.php");

if (isset($_POST['submit'])) {

    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    if ($password != $cpassword) {
        echo"<script>alert('password did not match')</script>";
        header("Location: registration.php"); 
        exit();
    }
    if(empty($name)||empty($email)||empty($phone)||empty($address)||empty($password)||empty($cpassword)){
        echo"<script>alert('all fields are required')</script>";
    }
    else{
        $sql="insert into reg(name,email,phone,address,password) values('$name','$email','$phone','$address','$password')";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo"Inserted";
        }
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
        Name:<input type="text" name="name" id="name">
        Email:<input type="text" name="email" id="email">
        Phone:<input type="text" name="phone" id="phone">
        address:<input type="text" name="address" id="address">
        password:<input type="text" name="password" id="password">
        cpassword:<input type="text" name="cpassword" id="cpassword">

        <button type="submit" name="submit">submit</button>
    </form>

</body>

</html>