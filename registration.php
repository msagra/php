<?php
include("dbconnect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Image file
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "uploads/" . $image;

    if ($password != $cpassword) {
        echo "<script>alert('Password did not match');</script>";
        header("refresh:0; url=registration.php");
        exit();
    }

    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($cpassword) || empty($image)) {
        echo "<script>alert('All fields are required');</script>";
    } else {
        // Move uploaded file to folder
        if (move_uploaded_file($tmp_name, $folder)) {
            $sql = "INSERT INTO reg(name,email,phone,address,password,image) 
                    VALUES('$name','$email','$phone','$address','$password','$image')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Inserted successfully');</script>";
            } else {
                echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
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
    <form method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="name"><br>
        Email: <input type="text" name="email"><br>
        Phone: <input type="text" name="phone"><br>
        Address: <input type="text" name="address"><br>
        Password: <input type="password" name="password"><br>
        Confirm Password: <input type="password" name="cpassword"><br>
        Upload Image: <input type="file" name="image"><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
