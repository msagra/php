<?php
include("dbconnect.php");
$id = intval($_GET['updateid']);

// Fetch existing data
$sql = "SELECT * FROM reg WHERE id=$id";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];

    // Image file
    $image     = $_FILES['image']['name'];
    $tmp_name  = $_FILES['image']['tmp_name'];
    $folder    = "uploads/" . $image;

    if (!empty($image)) {
        // New image uploaded
        move_uploaded_file($tmp_name, $folder);
        $sql = "UPDATE reg SET name='$name', email='$email', phone='$phone', address='$address', image='$image' WHERE id='$id'";
    } else {
        // Keep old image
        $sql = "UPDATE reg SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$id'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:index.php');
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $rows['name']; ?>"><br><br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $rows['email']; ?>"><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $rows['phone']; ?>"><br><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $rows['address']; ?>"><br><br>

        <label>Current Image:</label><br>
        <img src="uploads/<?php echo $rows['image']; ?>" width="100"><br><br>

        <label>Upload New Image:</label>
        <input type="file" name="image"><br><br>

        <button type="submit" name="submit">Update</button>
    </form>
</body>

</html>
