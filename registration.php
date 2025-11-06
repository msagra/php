<?php
include("dbconnect.php");

if (isset($_POST['submit'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $image    = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder   = "uploads/" . $image;  // Folder to store uploaded images

    // Check empty fields
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($cpassword) || empty($image)) {
        echo "<script>alert('All fields are required');</script>";
    }
    // Check password match
    elseif ($password != $cpassword) {
        echo "<script>alert('Passwords did not match');</script>";
    }
    else {
        // Check if email already exists
        $checkEmail = "SELECT * FROM reg WHERE email='$email'";
        $result = mysqli_query($conn, $checkEmail);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already registered!');</script>";
        } else {
            // Move uploaded image to folder
            if (move_uploaded_file($tempname, $folder)) {
                // Insert into database
                $sql = "INSERT INTO reg (name, email, phone, address, password, image) 
                        VALUES ('$name', '$email', '$phone', '$address', '$password', '$image')";
                $insert = mysqli_query($conn, $sql);

                if ($insert) {
                    echo "<script>alert('Registration successful');</script>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Image upload failed');</script>";
            }
        }
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <label>Name:</label><input type="text" name="name" id="name"><br>
    <label>Email:</label><input type="email" name="email" id="email"><br>
    <label>Phone:</label><input type="text" name="phone" id="phone"><br>
    <label>Address:</label><input type="text" name="address" id="address"><br>
    <label>Password:</label><input type="password" name="password" id="password"><br>
    <label>Confirm Password:</label><input type="password" name="cpassword" id="cpassword"><br>
    <label>Upload Image:</label><input type="file" name="image" id="image"><br>
    <button type="submit" name="submit">Submit</button>
</form>
